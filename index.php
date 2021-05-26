<?php
require_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'includes/head.php'; ?>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="jumbotron jumbotron-bg">
        <div class="container-fluid">
            <h1 class="text-center">Our Team</h1>
        </div>
    </div>

    <div class="container">
        <h2>Executive Leadership</h2>
        <div class="row">
            <?php
            $table = "SELECT * FROM team_bios";
            $result = $dbci->query($table);

            while ($row = $result->fetch_assoc()) { ?>
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="thumb">
                            <img class="card-img-top" src="<?= $row['photo'] ?>" alt="<?= $row['name'] ?>" data-toggle="modal" data-target=".modal-profile-lg">
                            <div class="card-body">
                                <h3 class="card-title member-name"><?= $row['name'] ?></h3>
                                <h6 class="card-text member-title"><?= $row['title'] ?></h6>
                                <h6 class="card-text view-bio" data-id="<?= $row['id'] ?>"><a href="#">View Bio <span><img src="./img/Vector.png" alt="View Bio for <?= $row['name'] ?>"></span></a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- .modal-profile -->
    <div class="modal fade modal-profile" tabindex="-1" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 ml-auto">
                                <h3 class="modal-title"></h3>
                                <h6 class="modal-subtitle member-title"></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 ml-auto">
                                <span class="modal-text"></span>
                            </div>
                            <div class="col-md-6 ml-auto">
                                <span class="modal-picture">
                                    <img class="modal-photo" src="" alt="">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <script>
        $(document).ready(function() {

            // Update "active" status based on last link clicked
            let linkContainer = document.getElementById("navbar");

            let links = linkContainer.getElementsByClassName("nav-link");

            for (let i = 0; i < links.length; i++) {
                links[i].addEventListener("click", function() {
                    let current = document.getElementsByClassName("active");
                    current[0].className = current[0].className.replace(" active", "");
                    this.className += " active";
                });
            }

            // Trigger modal, take id from data-attribute and populate corresponding data to corresponding bio clicked
            $('h6.view-bio').click(function(event) {
                event.preventDefault();
                let obj = $(this);
                let objID = obj.attr('data-id');
                $.ajax({
                    type: 'GET',
                    url: 'dbRequest.php',
                    data: {
                        'id': objID
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        data = data[0];
                        let [memberName, memberTitle, memberBio, memberPhoto] = [data[1], data[2], data[3], data[4]];
                        $('.modal-title').html(memberName);
                        $('.modal-subtitle').html(memberTitle);
                        $('.modal-text').html(memberBio);
                        $('.modal-photo').attr('src', memberPhoto);
                        $(".modal-profile").modal({
                            show: true
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>