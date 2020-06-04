<?php

namespace Model;

use Cassandra\RetryPolicy\Logging;
use Model\Domain\GUID;

/**
 * Class Order
 * @package Model
 */
class Order extends Model
{
    /**
     * @param float $total
     * @param string $userId
     * @return QueryResult
     */
    public function createOrder(float $total, string $userId): QueryResult
    {
        $orderId = GUID::generate();

        $statement =
            "insert into webshop.Order (order_id, user_id, order_total) values ( :orderId, :userId, :total)";

        $query = $this->db->prepare($statement);
        $query->bindValue(":total", $total, \PDO::PARAM_STR);
        $query->bindValue(":userId", $userId, \PDO::PARAM_STR);
        $query->bindValue(":orderId", $orderId, \PDO::PARAM_STR);

        try {
            $query->execute();
            foreach ($query->errorInfo() as $info) {
                echo $info;
            }
            return $this->getById($orderId);
        } catch (\PDOException $exception) {
            echo $exception;
            return new QueryResult(null, "An internal error");
        }
    }

    /**
     * @param string $id
     * @return QueryResult
     */
    public function getById(string $id): QueryResult
    {
        $query = $this->db->prepare("
            select * from webshop.Order where order_id = :id;
        ");

        try {
            $query->execute([":id" => $id]);
            $result = $query->fetch();
            if (!$result) {
                return new QueryResult(null, null);
            }
            return new QueryResult([self::mapToOrder($result)], null);
        } catch (\PDOException $exception) {
            return new QueryResult(null, "An Internal Error");
        }
    }

    /**
     * @param array $result
     * @return Domain\Order
     */
    private static function mapToOrder(array $result): \Model\Domain\Order
    {
        $user = (new User())->findById($result["user_id"])->getResult();
        return new \Model\Domain\Order(
            $result["order_id"],
            $result["order_total"],
            $user
        );
    }
}
