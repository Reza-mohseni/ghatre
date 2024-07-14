<?php
require_once '../../core/healper/healper.php';
require_once '../../Models/watering/select.php';
use App\Models\watering\select;

$selectInstance = new select;
$row1=$selectInstance->selectsendrow1();
$row2=$selectInstance->selectsendrow2();
$row3=$selectInstance->selectsendrow3();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= asset('watering/css/watering.css')?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0-rc.1/Chart.bundle.js"></script>
  <title>آبیاری</title>
</head>



<!-- منوی راست -->

<?php require_once '../menu/menu.php'; ?>
    <!-- هدر -->
    <?php require_once '../header/header.php'; ?>
    <!--هدر پیان -->
    <!-- باکس های وضعیت آبیاری -->
    <div class="conteyner-Irrigation__status">
        <div class="row-conteyner">
            <div class="row">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 191 104">
                    <g id="Group_1" data-name="Group 1" transform="translate(-652 -126)">
                        <g id="Rectangle_1" data-name="Rectangle 1" transform="translate(682 126)" fill="#fff" stroke="#666"
                           stroke-width="1">
                            <rect width="161" height="28" stroke="none" />
                            <rect x="0.5" y="0.5" width="160" height="27" fill="none" />
                        </g>
                        <g id="Rectangle_2" data-name="Rectangle 2" transform="translate(652 164)" fill="#fff" stroke="#707070"
                           stroke-width="1">
                            <rect width="161" height="28" stroke="none" />
                            <rect x="0.5" y="0.5" width="160" height="27" fill="none" />
                        </g>
                        <g id="Rectangle_3" data-name="Rectangle 3" transform="translate(652 202)" fill="#fff" stroke="#707070"
                           stroke-width="1">
                            <rect width="161" height="28" stroke="none" />
                            <rect x="0.5" y="0.5" width="160" height="27" fill="none" />
                        </g>
                        <g id="Ellipse_1" data-name="Ellipse 1" transform="translate(653 126)" fill="#666" stroke="#707070"
                           stroke-width="1">
                            <circle cx="14" cy="14" r="14" stroke="none" />
                            <circle cx="14" cy="14" r="13.5" fill="none" />
                        </g>
                    </g>
                </svg>
                <p class="tatel">ردیف:<?= ' ' . $row1[0]['watering_row']?></p>
            </div>

            <?php
            if ($row1[0]['status']==1)
            {
                ?>
                <div class="Condition-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="32" viewBox="0 0 73.84 36.92">
                        <g id="Group_4" data-name="Group 4" transform="translate(-13.08 -10)">
                            <path id="Path_2" data-name="Path 2" d="M68.46,10H31.54A18.46,18.46,0,0,0,13.08,28.46h0A18.46,18.46,0,0,0,31.54,46.92H68.46A18.46,18.46,0,0,0,86.92,28.46h0A18.46,18.46,0,0,0,68.46,10Zm0,34.46H31.54a16,16,0,0,1,0-32H68.46a16,16,0,0,1,0,32Z" fill="#666"/>
                            <circle id="Ellipse_2" data-name="Ellipse 2" cx="<?= '-25.31' ?>" cy="12.31" r="12.31" transform="translate(56.15 16.15)" fill="<?= '#028714' ?>"/>
                        </g>
                    </svg>
                    <p class="tatel">وضعیت آبیاری:<?= '  فعال'?></p>
                </div>
                <?php
            }else{
                ?>
                <div class="Condition-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="32" viewBox="0 0 73.84 36.92">
                        <g id="Group_4" data-name="Group 4" transform="translate(-13.08 -10)">
                            <path id="Path_2" data-name="Path 2" d="M68.46,10H31.54A18.46,18.46,0,0,0,13.08,28.46h0A18.46,18.46,0,0,0,31.54,46.92H68.46A18.46,18.46,0,0,0,86.92,28.46h0A18.46,18.46,0,0,0,68.46,10Zm0,34.46H31.54a16,16,0,0,1,0-32H68.46a16,16,0,0,1,0,32Z" fill="#666"/>
                            <circle id="Ellipse_2" data-name="Ellipse 2" cx="12.31" cy="12.31" r="12.31" transform="translate(56.15 16.15)" fill="#666"/>
                        </g>
                    </svg>



                    <p class="tatel">وضعیت آبیاری:<?= '  غیرفعال'?></p>
                    <p id="row3-Condition"></p>
                </div>
                <?php
            }
            ?>


            <div class="humidity-row">
                <svg xmlns="http://www.w3.org/2000/svg" width="20.5" height="19.5" viewBox="0 0 20.5 19.5">
                    <g id="Group_3" data-name="Group 3" transform="translate(-1.25 -2.25)">
                        <path id="Path_1" data-name="Path 1" d="M2,3a9.976,9.976,0,0,1,3.531.3A4,4,0,0,1,7.7,5.469,9.976,9.976,0,0,1,8,9a9.976,9.976,0,0,1-3.531-.3A4,4,0,0,1,2.3,6.531,9.976,9.976,0,0,1,2,3Z" fill="none" stroke="#666" stroke-linejoin="round" stroke-width="1.5"/>
                        <path id="Path_2" data-name="Path 2" d="M12,5a6.65,6.65,0,0,0-2.354.2A2.667,2.667,0,0,0,8.2,6.646,6.65,6.65,0,0,0,8,9a6.65,6.65,0,0,0,2.354-.2A2.667,2.667,0,0,0,11.8,7.354,6.65,6.65,0,0,0,12,5Z" fill="none" stroke="#666" stroke-linejoin="round" stroke-width="1.5"/>
                        <g id="Group_2" data-name="Group 2">
                            <path id="Path_3" data-name="Path 3" d="M8,9v5" fill="none" stroke="#666" stroke-linecap="round" stroke-width="1.5"/>
                            <path id="Path_4" data-name="Path 4" d="M12,14H2" fill="none" stroke="#666" stroke-linecap="round" stroke-width="1.5"/>
                            <path id="Path_5" data-name="Path 5" d="M12,17H2" fill="none" stroke="#666" stroke-linecap="round" stroke-width="1.5"/>
                            <path id="Path_6" data-name="Path 6" d="M12,20H2" fill="none" stroke="#666" stroke-linecap="round" stroke-width="1.5"/>
                        </g>
                        <path id="Path_7" data-name="Path 7" d="M16,18.5a5.133,5.133,0,0,1,1.792-3.212,1,1,0,0,1,1.415,0A5.133,5.133,0,0,1,21,18.5a2.5,2.5,0,0,1-5,0Z" fill="none" stroke="#666" stroke-width="1.5"/>
                    </g>
                </svg>

                <p class="tatel">رطوبت فعلی خاک: <?= $row1[0]['degree_humidity']?></p>
                <p id="row3-humidity"></p>
            </div>
        </div>
        <div class="row-conteyner">
            <div class="row">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 190 104">
                    <g id="Group_1" data-name="Group 1" transform="translate(-652 -132)">
                        <g id="Rectangle_2" data-name="Rectangle 2" transform="translate(652 132)" fill="#fff" stroke="#707070"
                           stroke-width="1">
                            <rect width="161" height="28" stroke="none" />
                            <rect x="0.5" y="0.5" width="160" height="27" fill="none" />
                        </g>
                        <g id="Rectangle_3" data-name="Rectangle 3" transform="translate(652 208)" fill="#fff" stroke="#707070"
                           stroke-width="1">
                            <rect width="161" height="28" stroke="none" />
                            <rect x="0.5" y="0.5" width="160" height="27" fill="none" />
                        </g>
                        <g id="Group_2" data-name="Group 2" transform="translate(-1 44)">
                            <g id="Rectangle_1" data-name="Rectangle 1" transform="translate(682 126)" fill="#fff" stroke="#666"
                               stroke-width="1">
                                <rect width="161" height="28" stroke="none" />
                                <rect x="0.5" y="0.5" width="160" height="27" fill="none" />
                            </g>
                            <g id="Ellipse_1" data-name="Ellipse 1" transform="translate(653 126)" fill="#666" stroke="#707070"
                               stroke-width="1">
                                <circle cx="14" cy="14" r="14" stroke="none" />
                                <circle cx="14" cy="14" r="13.5" fill="none" />
                            </g>
                        </g>
                    </g>
                </svg>
                <p class="tatel">ردیف:<?= ' ' . $row2[0]['watering_row']?></p>
            </div>

            <?php
            if ($row2[0]['status']==1)
            {
                ?>
                <div class="Condition-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="32" viewBox="0 0 73.84 36.92">
                        <g id="Group_4" data-name="Group 4" transform="translate(-13.08 -10)">
                            <path id="Path_2" data-name="Path 2" d="M68.46,10H31.54A18.46,18.46,0,0,0,13.08,28.46h0A18.46,18.46,0,0,0,31.54,46.92H68.46A18.46,18.46,0,0,0,86.92,28.46h0A18.46,18.46,0,0,0,68.46,10Zm0,34.46H31.54a16,16,0,0,1,0-32H68.46a16,16,0,0,1,0,32Z" fill="#666"/>
                            <circle id="Ellipse_2" data-name="Ellipse 2" cx="<?= '-25.31' ?>" cy="12.31" r="12.31" transform="translate(56.15 16.15)" fill="<?= '#028714' ?>"/>
                        </g>
                    </svg>
                    <p class="tatel">وضعیت آبیاری:<?= '  فعال'?></p>
                </div>
                <?php
            }else{
                ?>
                <div class="Condition-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="32" viewBox="0 0 73.84 36.92">
                        <g id="Group_4" data-name="Group 4" transform="translate(-13.08 -10)">
                            <path id="Path_2" data-name="Path 2" d="M68.46,10H31.54A18.46,18.46,0,0,0,13.08,28.46h0A18.46,18.46,0,0,0,31.54,46.92H68.46A18.46,18.46,0,0,0,86.92,28.46h0A18.46,18.46,0,0,0,68.46,10Zm0,34.46H31.54a16,16,0,0,1,0-32H68.46a16,16,0,0,1,0,32Z" fill="#666"/>
                            <circle id="Ellipse_2" data-name="Ellipse 2" cx="12.31" cy="12.31" r="12.31" transform="translate(56.15 16.15)" fill="#666"/>
                        </g>
                    </svg>



                    <p class="tatel">وضعیت آبیاری:<?= '  غیرفعال'?></p>
                    <p id="row3-Condition"></p>
                </div>
                <?php
            }
            ?>

            <div class="humidity-row">
                <svg xmlns="http://www.w3.org/2000/svg" width="20.5" height="19.5" viewBox="0 0 20.5 19.5">
                    <g id="Group_3" data-name="Group 3" transform="translate(-1.25 -2.25)">
                        <path id="Path_1" data-name="Path 1" d="M2,3a9.976,9.976,0,0,1,3.531.3A4,4,0,0,1,7.7,5.469,9.976,9.976,0,0,1,8,9a9.976,9.976,0,0,1-3.531-.3A4,4,0,0,1,2.3,6.531,9.976,9.976,0,0,1,2,3Z" fill="none" stroke="#666" stroke-linejoin="round" stroke-width="1.5"/>
                        <path id="Path_2" data-name="Path 2" d="M12,5a6.65,6.65,0,0,0-2.354.2A2.667,2.667,0,0,0,8.2,6.646,6.65,6.65,0,0,0,8,9a6.65,6.65,0,0,0,2.354-.2A2.667,2.667,0,0,0,11.8,7.354,6.65,6.65,0,0,0,12,5Z" fill="none" stroke="#666" stroke-linejoin="round" stroke-width="1.5"/>
                        <g id="Group_2" data-name="Group 2">
                            <path id="Path_3" data-name="Path 3" d="M8,9v5" fill="none" stroke="#666" stroke-linecap="round" stroke-width="1.5"/>
                            <path id="Path_4" data-name="Path 4" d="M12,14H2" fill="none" stroke="#666" stroke-linecap="round" stroke-width="1.5"/>
                            <path id="Path_5" data-name="Path 5" d="M12,17H2" fill="none" stroke="#666" stroke-linecap="round" stroke-width="1.5"/>
                            <path id="Path_6" data-name="Path 6" d="M12,20H2" fill="none" stroke="#666" stroke-linecap="round" stroke-width="1.5"/>
                        </g>
                        <path id="Path_7" data-name="Path 7" d="M16,18.5a5.133,5.133,0,0,1,1.792-3.212,1,1,0,0,1,1.415,0A5.133,5.133,0,0,1,21,18.5a2.5,2.5,0,0,1-5,0Z" fill="none" stroke="#666" stroke-width="1.5"/>
                    </g>
                </svg>

                <p class="tatel">رطوبت فعلی خاک: <?= $row2[0]['degree_humidity']?></p>
                <p id="row3-humidity"></p>
            </div>
        </div>
        <div class="row-conteyner">
            <div class="row">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 190 104">
                    <g id="Group_1" data-name="Group 1" transform="translate(-652 -132)">
                        <g id="Rectangle_2" data-name="Rectangle 2" transform="translate(652 132)" fill="#fff" stroke="#707070"
                           stroke-width="1">
                            <rect width="161" height="28" stroke="none" />
                            <rect x="0.5" y="0.5" width="160" height="27" fill="none" />
                        </g>
                        <g id="Rectangle_3" data-name="Rectangle 3" transform="translate(652 170)" fill="#fff" stroke="#707070"
                           stroke-width="1">
                            <rect width="161" height="28" stroke="none" />
                            <rect x="0.5" y="0.5" width="160" height="27" fill="none" />
                        </g>
                        <g id="Group_2" data-name="Group 2" transform="translate(-1 82)">
                            <g id="Rectangle_1" data-name="Rectangle 1" transform="translate(682 126)" fill="#fff" stroke="#666"
                               stroke-width="1">
                                <rect width="161" height="28" stroke="none" />
                                <rect x="0.5" y="0.5" width="160" height="27" fill="none" />
                            </g>
                            <g id="Ellipse_1" data-name="Ellipse 1" transform="translate(653 126)" fill="#666" stroke="#707070"
                               stroke-width="1">
                                <circle cx="14" cy="14" r="14" stroke="none" />
                                <circle cx="14" cy="14" r="13.5" fill="none" />
                            </g>
                        </g>
                    </g>
                </svg>

                <p class="tatel">ردیف:<?= ' ' . $row3[0]['watering_row']?></p>
            </div>


            <?php
            if ($row3[0]['status']==1)
            {
                ?>
                <div class="Condition-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="32" viewBox="0 0 73.84 36.92">
                        <g id="Group_4" data-name="Group 4" transform="translate(-13.08 -10)">
                            <path id="Path_2" data-name="Path 2" d="M68.46,10H31.54A18.46,18.46,0,0,0,13.08,28.46h0A18.46,18.46,0,0,0,31.54,46.92H68.46A18.46,18.46,0,0,0,86.92,28.46h0A18.46,18.46,0,0,0,68.46,10Zm0,34.46H31.54a16,16,0,0,1,0-32H68.46a16,16,0,0,1,0,32Z" fill="#666"/>
                            <circle id="Ellipse_2" data-name="Ellipse 2" cx="<?= '-25.31' ?>" cy="12.31" r="12.31" transform="translate(56.15 16.15)" fill="<?= '#028714' ?>"/>
                        </g>
                    </svg>
                    <p class="tatel">وضعیت آبیاری:<?= '  فعال'?></p>
                </div>
                <?php
            }else{
                ?>
                <div class="Condition-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="32" viewBox="0 0 73.84 36.92">
                        <g id="Group_4" data-name="Group 4" transform="translate(-13.08 -10)">
                            <path id="Path_2" data-name="Path 2" d="M68.46,10H31.54A18.46,18.46,0,0,0,13.08,28.46h0A18.46,18.46,0,0,0,31.54,46.92H68.46A18.46,18.46,0,0,0,86.92,28.46h0A18.46,18.46,0,0,0,68.46,10Zm0,34.46H31.54a16,16,0,0,1,0-32H68.46a16,16,0,0,1,0,32Z" fill="#666"/>
                            <circle id="Ellipse_2" data-name="Ellipse 2" cx="12.31" cy="12.31" r="12.31" transform="translate(56.15 16.15)" fill="#666"/>
                        </g>
                    </svg>



                    <p class="tatel">وضعیت آبیاری:<?= '  غیرفعال'?></p>
                    <p id="row3-Condition"></p>
                </div>
                <?php
            }
            ?>


            <div class="humidity-row">
                <svg xmlns="http://www.w3.org/2000/svg" width="20.5" height="19.5" viewBox="0 0 20.5 19.5">
                    <g id="Group_3" data-name="Group 3" transform="translate(-1.25 -2.25)">
                        <path id="Path_1" data-name="Path 1" d="M2,3a9.976,9.976,0,0,1,3.531.3A4,4,0,0,1,7.7,5.469,9.976,9.976,0,0,1,8,9a9.976,9.976,0,0,1-3.531-.3A4,4,0,0,1,2.3,6.531,9.976,9.976,0,0,1,2,3Z" fill="none" stroke="#666" stroke-linejoin="round" stroke-width="1.5"/>
                        <path id="Path_2" data-name="Path 2" d="M12,5a6.65,6.65,0,0,0-2.354.2A2.667,2.667,0,0,0,8.2,6.646,6.65,6.65,0,0,0,8,9a6.65,6.65,0,0,0,2.354-.2A2.667,2.667,0,0,0,11.8,7.354,6.65,6.65,0,0,0,12,5Z" fill="none" stroke="#666" stroke-linejoin="round" stroke-width="1.5"/>
                        <g id="Group_2" data-name="Group 2">
                            <path id="Path_3" data-name="Path 3" d="M8,9v5" fill="none" stroke="#666" stroke-linecap="round" stroke-width="1.5"/>
                            <path id="Path_4" data-name="Path 4" d="M12,14H2" fill="none" stroke="#666" stroke-linecap="round" stroke-width="1.5"/>
                            <path id="Path_5" data-name="Path 5" d="M12,17H2" fill="none" stroke="#666" stroke-linecap="round" stroke-width="1.5"/>
                            <path id="Path_6" data-name="Path 6" d="M12,20H2" fill="none" stroke="#666" stroke-linecap="round" stroke-width="1.5"/>
                        </g>
                        <path id="Path_7" data-name="Path 7" d="M16,18.5a5.133,5.133,0,0,1,1.792-3.212,1,1,0,0,1,1.415,0A5.133,5.133,0,0,1,21,18.5a2.5,2.5,0,0,1-5,0Z" fill="none" stroke="#666" stroke-width="1.5"/>
                    </g>
                </svg>

                <p class="tatel">رطوبت فعلی خاک: <?= $row3[0]['degree_humidity']?></p>
                <p id="row3-humidity"></p>
            </div>
        </div>
    </div>

    <!-- باکس های وضعیت آبیاری پایان -->
  <!-- نمودار -->
  <div class="chart-box">
      <h3>نمودار رطوبت خاک</h3>
      <canvas id="Chart"></canvas>
    </div>
  <!-- نمودار پایان -->
  <?php require_once '../footer/footer.php';?>

  <script src="<?= asset('script/form_setting.js') ?>"></script>
<script src="<?= asset('watering/js/watering.js') ?>"></script>


</body>

</html>