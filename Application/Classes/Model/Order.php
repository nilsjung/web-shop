<?php

namespace Model;

use Model\Domain\GUID;

class Order extends Model
{
    public function createOrder(float $total, $userId)
    {
        $orderId = GUID::generate();

        $query = $this->db->prepare("
            insert into Order (order_id, user_id, sum) values 
            (:order_id, :user_id, :sum );
        ");

        try {
            $query->execute([
                ":order_id" => $orderId,
                ":user_id" => $userId,
                ":sum" => $total,
            ]);
            return $this->getById($orderId);
        } catch (\PDOException $exception) {
            return new QueryResult(null, "An internal error");
        }
    }

    public function getById(string $id)
    {
        $query = $this->db->prepare("
            select * from Order where order_id = :id;
        ");

        try {
            $query->execute([":id" => $id]);
            $result = $query->fetch();
            return new QueryResult([self::mapToOrder($result)], null);
        } catch (\PDOException $exception) {
            return new QueryResult(null, "An Internal Error");
        }
    }

    private static function mapToOrder(array $result): \Model\Domain\Order
    {
        $user = (new User())->findById($result["user_id"])->getResult();
        return new \Model\Domain\Order(
            $result["order_id"],
            $result["sum"],
            $user
        );
    }
}
