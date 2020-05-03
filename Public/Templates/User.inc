<section class="container mt-5">
    <section>
        <h1>User Management Area</h1>
        <h4>Hello <?= $this->firstName ?></h4>
        <form>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first-name">First Name</label>
                    <input type="text" class="form-control" id="first-name" value="<?=$this->firstName?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="last-name">Last Name</label>
                    <input type="text" class="form-control" id="last-name" value="<?=$this->lastName?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="email-address">Email Address</label>
                    <input type="text" class="form-control" id="email-address" value="<?=$this->emailAddress?>">
                </div>
            </div>
        </form>
    </section>
</section>
