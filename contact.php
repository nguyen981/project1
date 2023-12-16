<?php
require_once __DIR__."/autoload/autoload.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $data =
        [
            "name" => postInput('name'),
            "email" => to_slug(postInput("email")),
            "phone" => postInput('phone'),
            "address" => postInput('address'),
            "content" => postInput('content'),
            "created_at" => date('Y-m-d H:i:s')
        ];

    $error = [];

    if (postInput('name') == ''){
        $error['name'] = "Yêu cầu nhập đầy đủ thông tin";
    }

    if (postInput('email') == ''){
        $error['email'] = "Yêu cầu nhập đầy đủ thông tin";
    }

    if (postInput('phone') == ''){
        $error['phone'] = "Yêu cầu nhập đầy đủ thông tin";
    }

    if (postInput('content') == ''){
        $error['content'] = "Yêu cầu nhập đầy đủ thông tin";
    }

    if (postInput('address') == ''){
        $error['address'] = "Yêu cầu nhập đầy đủ thông tin";
    }

    // error trống có nghĩa là không có lỗi
    if(empty($error)){
        $isset = $db->fetchOne("contact","name = '".$data['name']."' ");
        $id_insert = $db->insert("contact", $data);

        if($id_insert > 0)
        {
            $_SESSION['success'] = "Gửi liên hệ thành công ! Cửa hàng sẽ sớm liên hệ với bạn";

        }
        else
        {
            // Thêm thất bại
            $_SESSION['error'] = "Gửi liên hệ thất bại";
        }
    }
}
?>

<?php require_once __DIR__."/layouts/header.php"; ?>
<div class="col-md-9 bor">

    <section class="box-main1">
        <div class="product-title">
            <h2>
                <a href="#">
                    Liên hệ
                </a>
            </h2>
            <div class="title_hr_office">
                <div class="title_hr_icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="notification-text">
            <?php if (isset($_SESSION['success'])) :?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
        </div>
        <!--End.notification-text-->
        <div class="notification-text">
            <?php if (isset($_SESSION['error'])) :?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
        </div>
        <!--End.notification-text-->

        <div class="frm-contact">

            <form action="" method="POST">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Họ tên:</label>
                            <input type="text" name="name" class="form-control" id="email">
                            <?php if (isset($error['name'])): ?>
                                <p class="text-danger">
                                    <?php echo $error['name'] ?>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Số điện thoại:</label>
                            <input type="number" name="phone" class="form-control" id="email">
                            <?php if (isset($error['phone'])): ?>
                                <p class="text-danger">
                                    <?php echo $error['phone'] ?>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" id="email">
                            <?php if (isset($error['email'])): ?>
                                <p class="text-danger">
                                    <?php echo $error['email'] ?>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Địa chỉ:</label>
                            <input type="text" name="address" class="form-control" id="email">
                            <?php if (isset($error['address'])): ?>
                                <p class="text-danger">
                                    <?php echo $error['address'] ?>
                                </p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Nội dung:</label>
                    <textarea type="text" name="content" class="form-control" rows="6"></textarea>
                    <?php if (isset($error['content'])): ?>
                        <p class="text-danger">
                            <?php echo $error['content'] ?>
                        </p>
                    <?php endif ?>

                </div>

                <button type="submit" class="btn btn-success">Gửi liên hệ</button>
            </form>
        </div>

        <div class="contact-google-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d935.4691589238232!2d106.3212394!3d20.3053728!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31360973a369a097%3A0x42d90bbaf1763a09!2zSOG7lyB0cuG7oyBk4buLY2ggduG7pSBGYWNlYm9vayAtIELDuWkgxJDhu6ljIE5ndXnDqm4!5e0!3m2!1svi!2s!4v1702660737920!5m2!1svi!2s" width="850" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- Nội dung -->
    </section>
</div>
<?php require_once __DIR__."/layouts/footer.php"; ?>


