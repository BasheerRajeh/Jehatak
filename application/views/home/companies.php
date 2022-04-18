
            <div class="main-content p-3">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>جهات التدريب</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content-types">
                    <div class="row">
                    <?php foreach ($companies as $company) { ?>
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <a href="<?php echo URL; ?>home/profile/<?php echo $company->user_id; ?>"><img class="img-fluid"
                                            style="height: 200px; object-fit: cover;"
                                            src="<?php echo URL; ?>public/images/companies/<?php echo $company->image_url; ?>"
                                            alt="<?php echo $company->name; ?>"></a>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <h3><a href="<?php echo URL; ?>home/profile/<?php echo $company->user_id; ?>"><?php echo $company->name; ?></a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </section>
            </div>
            
        </div>
    </div>