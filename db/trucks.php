<?php
// year,cab,engine,wheel base,drive train,fgawr,gvwr,rear wheel,bed,trim pkg,headlamp,plow model,subframe,mount kit,center member,note 1,note 2,note 3,note 4,note 5,note 6,note 7,note 8,note 9,note 10

$table = "TRUCKS";
$query = "SELECT id FROM " . $table;
$result = mysqli_query($conn, $query);

if (empty($result)) {
  echo "<p>" . $table . " table does not exist so one has been created.</p>";
  $query = mysqli_query($conn, "CREATE TABLE IF NOT EXISTS $table (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`),
    -- csv data
    `year` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `cab` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `engine` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `wheel_base` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `drive_train` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `fgawr` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `gvwr` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `rear_wheel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `bed` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `trim_pkg` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `headlamp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `plow_model` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
    `subframe` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `mount_kit` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `center_member` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `note_1` varchar(360) COLLATE utf8_unicode_ci NOT NULL,
    `note_2` varchar(360) COLLATE utf8_unicode_ci NOT NULL,
    `note_3` varchar(360) COLLATE utf8_unicode_ci NOT NULL,
    `note_4` varchar(360) COLLATE utf8_unicode_ci NOT NULL,
    `note_5` varchar(360) COLLATE utf8_unicode_ci NOT NULL,
    `note_6` varchar(360) COLLATE utf8_unicode_ci NOT NULL,
    `note_7` varchar(360) COLLATE utf8_unicode_ci NOT NULL,
    `note_8` varchar(360) COLLATE utf8_unicode_ci NOT NULL,
    `note_9` varchar(360) COLLATE utf8_unicode_ci NOT NULL,
    `note_10` varchar(360) COLLATE utf8_unicode_ci NOT NULL,
    -- end csv data
    `created` datetime NOT NULL,
    `modified` datetime NOT NULL
  )");
} else {
  // echo "<p>" . $table . " table already exists</p>";
}

?>
