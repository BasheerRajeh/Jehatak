<div class="main-content p-3">

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>الصفحة الشخصية</h3>
                </div>
            </div>
        </div>
    </div>

    <section class="section  m-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">لوحة التحكم</h5>
                </div>
                <div class="card-body">
                    <ul class="col-12 nav nav-tabs justify-content-between p-5 mb-5" id="myTab"
                        role="tablist">
                        <li class="col-md-3 col-12 nav-item text-center" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                               role="tab" aria-controls="home" aria-selected="true">
                                عرض الطلاب المقبولين</a>
                        </li>
                        <li class="col-md-3 col-12 nav-item text-center" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile"
                               role="tab" aria-controls="profile" aria-selected="false">إضافة مشرف
                                جامعي</a>
                        </li>
                        <li class="col-md-3 col-12 nav-item text-center" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact"
                               role="tab" aria-controls="contact" aria-selected="false">إضافة جهة تدريب</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                             aria-labelledby="home-tab">

                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>اسم الطالب</th>
                                            <th>اسم جهة التدريب</th>
                                            <th>المشرف</th>
                                            <th>الاختصاص</th>
                                            <th style="text-align: center;">الحالة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($students as $student) { ?>
                                        <tr>
                                            <td><?php echo $student->student_name; ?></td>
                                            <td><?php echo $student->training_company_name; ?></td>
                                            <td>
                                                <form action="<?php echo URL; ?>home/assignsupervisor/<?php echo $student->student_id; ?>" method="post">
                                                    <fieldset class="col-md-8 form-group">
                                                        <select class="form-select" name="supervisors" onchange="this.form.submit()">
                                                        <?php if (!isset($student->supervisor_user_id)) { ?>
                                                            <option selected>لم يتم التحديد بعد</option>
                                                        <?php }
                                                        foreach ($supervisors as $supervisor) { ?>
                                                            <option value="<?php echo $supervisor->user_id; ?>" <?php if (isset($student->supervisor_user_id)) {
                                                                if($student->supervisor_user_id == $supervisor->user_id) echo 'selected'; } ?>>
                                                                <?php echo $supervisor->name; ?>
                                                            </option>
                                                        <?php } ?>
                                                        </select>
                                                    </fieldset>
                                                </form>
                                            </td>
                                            <td><?php echo $student->speciality_name; ?></td>
                                            <td style="text-align: center;">
                                            <?php if (isset($student->supervisor_user_id)) { ?>
                                                <button class="btn btn-success" disabled><span><i class="fas fa-paper-plane"></i></span>&nbsp;لديه مشرف</button>
                                            <?php } else { ?>
                                                <button class="btn btn-danger" disabled><span><i class="fas fa-paper-plane"></i></span>&nbsp;لا يملك مشرف</button>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel"
                             aria-labelledby="profile-tab">

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <img class="img-fluid w-100" id="image1" src="<?php echo URL; ?>public/images/users/user.jpeg"
                                                 alt="الصورة الشخصية">
                                        </div>
                                        <div class="col-md-6 col-12 m-3">
                                            <form class="form form-horizontal" action="<?php echo URL; ?>home/addsupervisor" method="post" enctype="multipart/form-data">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>اسم المشرف</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control"
                                                            name="name" placeholder="الاسم" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>الإيميل</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="email"
                                                                   class="form-control"
                                                                   name="email" placeholder="name@gmail.com" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>الرقم الوطني</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" id="contact-info"
                                                                   class="form-control"
                                                                   name="n_id" placeholder="123456789" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>كلمة المرور</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="password" id="password"
                                                                   class="form-control" value=""
                                                                   name="password" placeholder="كلمة المرور" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>رابط الصورة</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="file" id="uploadBox1"
                                                                   class="form-control" name="image"
                                                                   placeholder="رابط الصورة" accept="image/*">
                                                        </div>
                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                            <button type="submit"
                                                                    class="btn btn-primary me-1 mb-1">أضف
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel"
                             aria-labelledby="contact-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <img class="img-fluid w-100" id="image2" src="<?php echo URL; ?>public/images/companies/default.jpg"
                                                 alt="الصورة الشخصية">
                                        </div>
                                        <div class="col-md-6 col-12 m-3">
                                            <form class="form form-horizontal" action="<?php echo URL; ?>home/addcompany" method="post" enctype="multipart/form-data">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>اسم الشركة</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text"
                                                                   class="form-control" name="name"
                                                                   placeholder="الاسم" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>الإيميل</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="email"
                                                                   class="form-control"
                                                                   name="email" placeholder="name@gmail.com" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>كلمة المرور</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="password" id="password"
                                                                   class="form-control" value=""
                                                                   name="password" placeholder="كلمة المرور" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>رابط الصورة</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="file" id="uploadBox2"
                                                                   class="form-control" name="image"
                                                                   placeholder="رابط الصورة" accept="image/*">
                                                        </div>
                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                            <button type="submit"
                                                                    class="btn btn-primary me-1 mb-1">أضف
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

</div>
</div>

<script>
        var fileToRead1 = document.getElementById("uploadBox1");
        var fileToRead2 = document.getElementById("uploadBox2");

        fileToRead1.addEventListener("change", function (event) {
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
            else {
                $(this).val('');
                $('#image1').attr('src', '<?php echo URL; ?>public/images/users/user.jpeg');
            }
        });

        fileToRead2.addEventListener("change", function (event) {
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image2').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
            else {
                $(this).val('');
                $('#image2').attr('src', '<?php echo URL; ?>public/images/companies/default.jpg');
            }
        });
</script>