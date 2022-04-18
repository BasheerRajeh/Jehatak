<div class="main-content p-3">

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>جميع المشرفين</h3>
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
                        <th>اسم المشرف</th>
                        <th>الإيميل</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($supervisors)) {
                        foreach ($supervisors as $supervisor) { ?>
                            <tr>

                                <td><?php echo $supervisor->name; ?></td>
                                <td><?php echo $supervisor->email; ?></td>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
</div>