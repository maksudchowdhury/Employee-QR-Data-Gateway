<?php
include 'db_con.php';
// $sub_path="/team/";
$sub_path = "";
?>


<!DOCTYPE html>
<html lang="en">

<!-- head section goes below -->

<?php include 'head.php'; ?>
<?php include './variables.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://matcha.mizu.sh/matcha.css">


<body>

    <?php include 'topbar.php'; ?>

    <!-- here goes the navbar -->
    <?php include 'navbar.php' ?>











    <main id="main" class="">

        <section id="hero" class="d-flex align-items-center" style="background: url('./assets/img/teamBG.jpg') top center;background-repeat: no-repeat;background-size: cover">
            <div class="container position-relative d-flex flex-column align-items-center mt-5" data-aos="fade-up" data-aos-delay="500">
                <div class="w-100">

                    <img class="img-fluid img-thumbnail rounded mx-auto d-block rounded-circle mt-2" src="<?php echo  $sub_path . $emp_image_path; ?>" alt="" style="width: 8rem;"><br>
                </div>

                <div class="row justify-content-center">
                    <div class="col-auto">
                        <table class="table table-hover text-start" data-bs-theme="dark">

                            <tbody>
                                <tr>
                                    <!-- <th scope="row">1</th> -->
                                    <td class="col-3 text-align-left"><b>Name</b></td>
                                    <td><?php echo  $emp_name; ?></td>

                                </tr>
                                <tr>
                                    <!-- <th scope="row">2</th> -->
                                    <td class="col-3"><b>Department</b></td>
                                    <td><?php echo  $emp_department; ?></td>

                                </tr>
                                <tr>
                                    <!-- <th scope="row">2</th> -->
                                    <td class="col-3"><b>Designation</b></td>
                                    <td><?php echo  $emp_designation; ?></td>

                                </tr>
                                <tr>
                                    <!-- <th scope="row">2</th> -->
                                    <td class="col-3"><b>Contact</b></td>
                                    <td><a href="https://wa.me/<?php echo  $emp_contact; ?>" target="_blank" class="text-light"><i class="bi bi-whatsapp text-success"></i></i>&nbsp;<?php echo  $emp_contact; ?></a></td>

                                </tr>

                                <tr>
                                    <!-- <th scope="row">2</th> -->
                                    <td class="col-3"><b>Email</b></td>
                                    <!-- <td><a href="mailto:info@freightageglobal.com" class="text-light"><i class="bx bx-envelope text-light"></i></i></a></td> -->
                                    <td><a href="mailto: <?php echo  $emp_email; ?>" class="text-light"><?php echo  $emp_email; ?></a></td>

                                </tr>

                                <tr>
                                    <!-- <th scope="row">2</th> -->
                                    <td class="col-3"><b>Job Status</b></td>
                                    <td id="activeEmp" class=""><b id="jobStat" class="">&nbsp;<?php echo  strtoupper($emp_job_status); ?>&nbsp;</b></td>
                                    <!--<td id="activeEmp" class=""><b id="jobStat" class="bg-success">&nbsp;<?php echo  strtoupper($emp_job_status); ?>&nbsp;</b></td>-->
                                    <!--<td id="inactiveEmp" class=""><b class="bg-warning text-dark">&nbsp;<?php strtoupper($emp_job_status); ?>&nbsp;</b></td>-->
                                    <!--<td id="terminatedEmp" class=""><b class="bg-danger">&nbsp;<?php echo  strtoupper($emp_job_status); ?>&nbsp;</b></td>-->

                                </tr>



                            </tbody>
                        </table>
                    </div>
                </div>



                <hr>
                <h5 class="text-light">Emergency Information</h5>


                <div class="row justify-content-center">
                    <div class="col-auto">
                        <table class="table table-hover table-responsive" data-bs-theme="dark">

                            <tr>
                                <!-- <th scope="row">3</th> -->
                                <td class=""><b>Blood Group</b></td>
                                <td class="text-left"><?php echo  $emp_blood_group; ?></td>
                            </tr>


                        </table>
                    </div>
                </div>


                <!-- <a href="#about" class="btn-get-started scrollto">Get Started</a> -->

        </section>



    </main><!-- End #main -->

    <!-- ======= Footer ======= -->

    <?php include 'footer.php'; ?>


    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script>
        let status = "<?php echo $emp_job_status ?>".toLowerCase();
        let element = document.getElementById('jobStat');
        if (status === 'active') {
            // document.getElementById('inactiveEmp').classList.add('d-none');
            // document.getElementById('terminatedEmp').classList.add('d-none');
            element.classList.add("bg-success");
        } else if (status === 'inactive') {

            // document.getElementById('activeEmp').classList.add('d-none');
            // document.getElementById('terminatedEmp').classList.add('d-none');
            element.classList.add("bg-warning");
            element.classList.add("text-dark");


        } else if (status === 'terminated') {

            // document.getElementById('activeEmp').classList.add('d-none');
            // document.getElementById('inactiveEmp').classList.add('d-none');
            element.classList.add("bg-danger");
            element.classList.add("text-dark");

        }
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script> -->



    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>