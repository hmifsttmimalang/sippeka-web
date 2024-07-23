<body class="bg_register">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-7">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <?php if (isset($data['success'])) : ?>
                                            <h1 class="h4 text-gray-900 mb-4"><?= $data['success'] ?></h1>
                                        <?php endif; ?>
                                    </div>
                                        <a href="<?= MAIN_URL ?>" class="btn btn-primary btn-user btn-block">
                                            Kembali ke halaman
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>