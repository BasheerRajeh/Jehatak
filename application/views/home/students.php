            <div class="main-content p-3">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>جميع الطلاب</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="section  m-3">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped mt-3" id="table1">
                                <thead>
                                    <tr>
                                        <th>اسم الطالب</th>
                                        <th>الإيميل</th>
                                        <th>الرقم الجامعي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($students as $student) { ?>
                                    <tr>
                                        <td><?php echo $student->name; ?></td>
                                        <td><?php echo $student->email; ?></td>
                                        <td><?php echo $student->universe_id; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>