<div class="checkout-process__container container mt-4">
    <div class="card ">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <?php if (!$this->isAuthenticated) : ?>
                    <li class="nav-item">
                        <a class="nav-link tex-info <?=$this->paymentStep === 0 ? "active" : "" ?>" href="/payment?step=0&token=<?=$this->token?>">Login</a>
                    </li>
                <?else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-info <?=$this->paymentStep === 1 ? "active" : "" ?>" href="/payment?step=1&token=<?=$this->token?>">Personal Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-info <?=$this->paymentStep === 2 ? "active" : "" ?>" href="/payment?step=2&token=<?=$this->token?>">Order Check and payment method</a>
                    </li>
                <?endif;?>
            </ul>
        </div>
        <div class="card-body">
            <?php if ($this->paymentStep === 0) : ?>
                <?=$this->loginPartial?>
            <?endif;?>
            <?php if ($this->paymentStep === 1) : ?>
                <?=$this->userPartial?>
            <?endif; ?>
            <?php if ($this->paymentStep === 2) : ?>
                <?=$this->paymentPartial?>
            <?endif; ?>
        </div>
    </div>
</div>
