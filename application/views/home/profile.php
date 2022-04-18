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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">المعلومات</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <img id="image" class="img-fluid w-100" src="<?php echo URL; ?>public/images/<?php
                        if ($user->role_id == 4) echo 'companies/';
                        else echo 'users/';
                        echo $user->image_url; ?>" alt="الصورة الشخصية">
                    </div>
                    <div class="col-md-6 col-12 m-3">
                        <form class="form form-horizontal" action="<?php echo URL; ?>home/edituserprofile" method="POST"
                              enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>الاسم</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="name" class="form-control" name="name"
                                               value="<?php echo $user->name; ?>" placeholder="الاسم" required disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label>الإيميل</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="email" id="email" class="form-control"
                                               value="<?php echo $user->email; ?>" name="email" placeholder="الإيميل"
                                               required disabled>
                                    </div>
                                    <?php if ($user->role_id == 3) { ?> <!-- طالب -->
                                        <div class="col-md-4">
                                            <label>الرقم الجامعي</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="u_id" class="form-control"
                                                   value="<?php if (isset($student->universe_id)) echo $student->universe_id; ?>"
                                                   name="u_id" placeholder="الرقم الجامعي" disabled>
                                        </div>
                                    <?php }
                                    if ($user->role_id == 3) { ?> <!-- طالب -->
                                        <div class="col-md-4">
                                            <label>الرقم الوطني</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="n_id" class="form-control"
                                                   value="<?php if (isset($student->national_id)) echo $student->national_id; ?>"
                                                   name="n_id" placeholder="الرقم الوطني" disabled>
                                        </div>
                                    <?php }
                                    if ($user->role_id == 2) { ?> <!-- مشرف -->
                                        <div class="col-md-4">
                                            <label>الرقم الوطني</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="n_id" class="form-control"
                                                   value="<?php if (isset($supervisor->national_id)) echo $supervisor->national_id; ?>"
                                                   name="n_id" placeholder="الرقم الوطني" disabled>
                                        </div>
                                    <?php }
                                    if ($user->role_id == 3) { ?> <!-- طالب -->
                                        <div class="col-md-4">
                                            <label>المعدل الجامعي</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="rate" class="form-control"
                                                   value="<?php if (isset($student->rate)) echo $student->rate; ?>"
                                                   name="rate" placeholder="المعدل الحامعي" disabled>
                                        </div>
                                    <?php }
                                    if ($user->role_id == 3) { ?> <!-- طالب -->
                                        <div class="col-md-4">
                                            <label>التخصص الجامعي</label>
                                        </div>
                                        <fieldset class="col-md-8 form-group">
                                            <select class="form-select" id="spec" name="spec" disabled>
                                                <?php if (!isset($student->speciality_id)) { ?>
                                                    <option selected></option>
                                                <?php }
                                                foreach ($specialities as $speciality) { ?>
                                                    <option value="<?php echo $speciality->id; ?>" <?php if (isset($student->speciality_id)) {
                                                        if ($student->speciality_id == $speciality->id) echo 'selected';
                                                    } ?>>
                                                        <?php echo $speciality->name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </fieldset>
                                    <?php }
                                    if (isset($_SESSION['email'])) {
                                        if ($_SESSION['id'] == $user->id) { ?>
                                            <div class="col-md-4">
                                                <label>تغيير كلمة المرور</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="password" id="password" class="form-control" required
                                                       value="" name="password" placeholder="كلمة المرور الجديدة"
                                                       minlength="5" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label>استعراض صورة</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="file" id="url-img" class="form-control" name="image"
                                                       placeholder="رابط الصورة" accept="image/*" disabled>
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="button" id="button" class="btn btn-primary me-1 mb-1"
                                                        onclick="editUser();">تفعيل
                                                    التعديل
                                                </button>
                                                <button type="submit" id="submit" class="btn btn-primary me-1 mb-1"
                                                        disabled>احفظ
                                                    التغييرات
                                                </button>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($user->role_id == 3 && isset($student->training_company_id)) { ?> <!-- طالب -->
            <div class="col-12 col-md-6 mb-3 mt-5 order-last">
                <h3>جهات التدريب</h3>
            </div>
            <div class="row">
                <div class="card col-md-3 m-3 col-12">
                    <div class="card-header">
                        <a href="<?php echo URL; ?>home/profile/<?php echo $company->user_id; ?>"><img
                                    class="col-12 img-fluid"
                                    src="<?php echo URL; ?>public/images/companies/<?php echo $company->image_url; ?>"
                                    alt="<?php echo $company->name; ?>">
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="col-12 text-center">
                            <h5>
                                <a href="<?php echo URL; ?>home/profile/<?php echo $company->user_id; ?>"><?php echo $company->name; ?></a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ($user->role_id == 3) { ?>
            <div class="col-12 col-md-6 mb-3 mt-5 order-last">
                <h3>جهات التدريب</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <p class="card-text">لا يوجد جهات تدريب</p>
                </div>
            </div>
        <?php }

        if ($user->role_id == 4 && $user->id == $_SESSION['id']) { ?> <!-- شركة ضمن بروفايلها -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="col-12 nav nav-tabs justify-content-around p-5 mb-5" id="myTab"
                            role="tablist">
                            <li class="col-md-3 col-12 nav-item text-center" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                   role="tab" aria-controls="home" aria-selected="true">عرض طلبات الطلاب</a>
                            </li>
                            <li class="col-md-3 col-12 nav-item text-center" role="presentation">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact"
                                   role="tab" aria-controls="contact" aria-selected="false">رسائل المشرفين</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                 aria-labelledby="home-tab">

                                <script>
                                    function loadMessage($element_id, $message) {
                                        document.getElementById($element_id).innerHTML = $message ?? "لا توجد رسالة";
                                    }
                                </script>

                                <div class="card-body">
                                    <table class="table table-striped" id="table2">
                                        <thead>
                                        <tr>
                                            <th>اسم الطالب</th>
                                            <th>رسالة الطالب</th>
                                            <th style="text-align: center;">حالة الطلب</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($studentsInfo)) {
                                            foreach ($studentsInfo as $info) { ?>
                                                <tr>
                                                    <td><?php echo $info->name ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-primary block"
                                                                onclick="loadMessage('msg_student_content','<?php
                                                                echo str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $info->message);
                                                                ?>')"
                                                                data-bs-toggle="modal" data-bs-target="#studentMessage">
                                                            عرض الرسالة
                                                        </button>
                                                    </td>
                                                    <?php if ($info->status == "Pending") { ?>
                                                        <td style="text-align: center;">
                                                            <a href="<?php echo URL; ?>home/acceptrequest/<?php echo $info->id; ?>">
                                                                <button class="btn btn-primary">قبول</button>
                                                            </a>&nbsp;
                                                            <a href="<?php echo URL; ?>home/rejectrequest/<?php echo $info->id; ?>">
                                                                <button class="btn btn-danger">رفض</button>
                                                            </a>&nbsp;
                                                        </td>
                                                    <?php } else { ?>
                                                        <td style="text-align: center;">
                                                            <?php if ($info->status == "Accepted") { ?>
                                                                <span class="badge bg-success">تم القبول</span>
                                                            <?php } else { ?>
                                                                <span class="badge bg-danger">مرفوض</span>
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="contact" role="tabpanel"
                                 aria-labelledby="contact-tab">
                                <div class="card-body">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                        <tr>
                                            <th>اسم المشرف</th>
                                            <th>رسالة المشرف</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($supervisorsInfo)) {
                                            foreach ($supervisorsInfo as $info) { ?>

                                                <tr>
                                                    <td><?php echo $info->name; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-primary block"
                                                                data-bs-toggle="modal"
                                                                onclick="loadMessage('msg_supervisor_content','<?php
                                                                echo str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $info->text);
                                                                ?>')"
                                                                data-bs-target="#supervisorMessage">عرض الرسالة
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="studentMessage" tabindex="-1" role="dialog"
                 aria-labelledby="studentMessageTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                     role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="studentMessageTitle">
                                محتوى الرسالة
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="msg_student_content">
                                أنا الطالب الفلاني أريد الانتساب لديكم
                            </p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">أغلق</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="supervisorMessage" tabindex="-1" role="dialog"
                 aria-labelledby="supervisorMessageTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                     role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="supervisorMessageTitle">
                                محتوى الرسالة
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="msg_supervisor_content">
                                رسالة المشرف
                            </p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">أغلق</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        <?php } elseif ($_SESSION['id'] != $user->id && $_SESSION['role_name'] == "طالب" && isset($isCompany) && !$hasRequest) { ?>
            <section class="section">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header m-3">
                                أكتب رسالتك وأرسلها لطلب التدريب
                            </div>
                            <div class="card-body">
                                <form class="form form-horizontal" method="post"
                                      action="<?php echo URL; ?>home/addrequest">
                                    <div class="form-body">
                                        <div class="form-group m-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">
                                                الرسالة
                                            </label>
                                            <input type="hidden" name="student_id"
                                                   value="<?php echo $_SESSION['id']; ?>">
                                            <input type="hidden" name="training_id" value="<?php echo $user->id; ?>">
                                            <textarea class="form-control" id="FormControlTextarea1" name="message"
                                                      rows="3" minlength="10" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-outline-success m-4"
                                                data-bs-toggle="modal" data-bs-target="#inlineForm">
                                            أرسل الرسالة
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } elseif ($user->role_id == 2 && $user->id == $_SESSION['id'] && isset($students)) { ?> <!-- مشرف ضمن بروفايله -->
            <div class="col-12 col-md-6 mb-3 mt-5 order-last">
                <h3>الطلاب</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                        <tr>
                            <th>اسم الطالب</th>
                            <th>اسم الشركة</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($students as $student) { ?>
                            <tr>
                                <td><?php echo $student->name; ?></td>
                                <td><?php echo $student->company; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <p class="card-text m-5">
                        أنشئ رسالة قبول الطلبة
                        &nbsp;

                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#inlineForm">
                            أنشئ
                        </button>
                    </p>
                    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">الرسالة</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <?php
                                $data = null;
                                $ids = null;
                                foreach ($students as $student) {
                                    $data["$student->company"][] = $student->name;
                                    $ids["$student->company"][] = $student->comId;
                                }
                                ?>
                                <form action="<?php echo URL; ?>home/sendcompanymessage" method="POST">
                                    <div class="modal-body">
                                        <label>جهة الإرسال: </label>
                                        <fieldset class="form-group">
                                            <select class="form-select" id="basicSelect" name="company">
                                                <option value="">لم يتم التحديد</option>
                                                <?php foreach ($data as $k => $v) { ?>
                                                    <option value="<?php echo $ids[$k][0]; ?>"><?php echo $k; ?></option>
                                                <?php } ?>
                                            </select>
                                        </fieldset>
                                        <label>من : </label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="from">
                                        </div>
                                        <label>إلى : </label>
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="to">
                                        </div>
                                        <?php
                                        $names = "";
                                        foreach (array_values($data)[0] as $value) {
                                            $names = $names . "\n" . $value;
                                        }
                                        ?>
                                        <input type="hidden" value="<?php echo $names; ?>" name="names">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary"
                                                data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">أغلق</span>
                                        </button>
                                        <input type="submit" value="أرسل" id="submit" name="submit"
                                               class="btn btn-primary ml-1">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
</div>
</div>
</div>

<script>
    var fileToRead = document.getElementById("url-img");
    fileToRead.addEventListener("change", function (event) {
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $(this).val('');
            $('#image').attr('src', '<?php echo URL; ?>public/images/<?php
                if ($user->role_id == 4) echo 'companies/' . $_SESSION['image_url'];
                else echo 'users/' . $_SESSION['image_url']; ?>');
        }
    });
</script>
<script src="<?php echo URL; ?>public/js/profile.js"></script>