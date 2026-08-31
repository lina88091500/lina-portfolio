<?php include_once "./api/db.php";?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bloom Aesthetic Studio | 品牌專櫃後台管理中心</title>
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌸</text></svg>">
<link href="./css/css.css" rel="stylesheet" type="text/css">
<script src="./js/jquery-1.9.1.min.js"></script>
<script src="./js/js.js"></script>
</head>

<body>

<div id="cover" style="display:none;">
	<div id="coverr">
    	<a style="position:absolute; right:15px; top:12px; cursor:pointer; z-index:9999; font-size:20px; color:#7E4A52;" onclick="cl('#cover')">✕</a>
        <div id="cvr" style="position:absolute; width:95%; height:90%; margin:auto; z-index:9898;"></div>
    </div>
</div>

<div id="main">
		<!-- 🎨 個人美妝作品專屬徽章 -->
		<div class="artist-badge">
			ADMIN CONSOLE 專櫃後台
		</div>

    	<?php 
        $titleImg = "upload/header_jbeauty_v2.png";
		$titleText = "Bloom Aesthetic Studio - 品牌後台管理中心";
		if (isset($Title)) {
			$title = $Title->find(['sh'=>1]);
			if (!empty($title['img']) && file_exists("upload/".$title['img'])) {
				$titleImg = "upload/".$title['img'];
			}
			if (!empty($title['text'])) {
				$titleText = $title['text'];
			}
		}
		$currentDo = $_GET['do'] ?? "title";
		?>
    	<a title="<?= htmlspecialchars($titleText); ?>" href="index.php">
			<!--頂部 Header 廣告 Banner-->
			<div class="ti" style="background-image: url('<?= $titleImg ?>');">
			</div>
		</a>

    	<div id="ms">
            <!--🔒 左側後台管理導覽欄 (100% 前後台同款型態選單)-->
            <div id="lf">
                <div id="menuput" class="dbor">
                    <span class="t botli">後台管理選單</span>
                    <div class="mainmu cent <?= ($currentDo=='title')?'active-menu':''; ?>">
                        <a href="?do=title">網站標題管理</a>
                    </div>
                    <div class="mainmu cent <?= ($currentDo=='ad')?'active-menu':''; ?>">
                        <a href="?do=ad">動態文字廣告管理</a>
                    </div>
                    <div class="mainmu cent <?= ($currentDo=='mvim')?'active-menu':''; ?>">
                        <a href="?do=mvim">動畫圖片管理</a>
                    </div>
                    <div class="mainmu cent <?= ($currentDo=='image')?'active-menu':''; ?>">
                        <a href="?do=image">校園映象資料管理</a>
                    </div>
                    <div class="mainmu cent <?= ($currentDo=='total')?'active-menu':''; ?>">
                        <a href="?do=total">進站總人數管理</a>
                    </div>
                    <div class="mainmu cent <?= ($currentDo=='bottom')?'active-menu':''; ?>">
                        <a href="?do=bottom">頁尾版權資料管理</a>
                    </div>
                    <div class="mainmu cent <?= ($currentDo=='news')?'active-menu':''; ?>">
                        <a href="?do=news">最新消息資料管理</a>
                    </div>
                    <div class="mainmu cent <?= ($currentDo=='admin')?'active-menu':''; ?>">
                        <a href="?do=admin">管理者帳號管理</a>
                    </div>
                    <div class="mainmu cent <?= ($currentDo=='menu')?'active-menu':''; ?>">
                        <a href="?do=menu">選單管理</a>
                    </div>
                </div>

                <!--訪客計數卡片-->
                <div class="dbor cent" style="margin-top:8px; width:100%; height:68px; display:flex; flex-direction:column; justify-content:center; align-items:center;">
                    <?php 
                    $totalCount = 12580;
                    if (isset($Total)) {
                        $tData = $Total->find(1);
                        if (!empty($tData['total'])) $totalCount = $tData['total'];
                    }
                    ?>
                    <span class="t" style="font-size:11px; color:#8C7075; padding:0;">VIP VISITORS</span>
                    <span style="font-size:14px; font-weight:700; color:#7E4A52; letter-spacing:0.8px; margin-top:2px;">
                    	🌸 貴賓蒞臨 : <?= number_format($totalCount); ?> 人
                    </span>
                </div>
            </div>

            <!--🔒 中央後台頁面面板 (FixedWidth 755px)-->
            <?php 
            $do = $_GET['do'] ?? "title";
            $file = "back/$do.php";
            if (file_exists($file)) {
                include $file;
            } else {
                include "back/title.php";
            }
            ?>

            <div id="alt" style="position: absolute; width: 340px; min-height: 100px; word-break:break-all; text-align:justify; background-color: rgba(255, 253, 249, 0.98); top: 50px; left: 320px; z-index: 99; display: none; padding: 12px; border: 1px solid var(--j-pink-accent); border-radius:12px; box-shadow: var(--j-shadow-md); pointer-events:none;"></div>
            <script>
            $(".sswww").hover(
                function () {
                    $("#alt").html(""+$(this).children(".all").html()+"").css({"top":$(this).offset().top-50})
                    $("#alt").show()
                },
                function() {
                    $("#alt").hide()
                }
            )
            </script>
        </div>

        <div style="clear:both;"></div>

        <!--頁尾區 Footer-->
        <div>
            <span class="t">
                <?php 
                $bottomText = "© 2026 Bloom Aesthetic Studio. All Rights Reserved. 專屬日系美妝美學作品集";
                if(isset($Bottom)) {
                    $b = $Bottom->find(1);
                    if(!empty($b['bottom'])) $bottomText = $b['bottom'];
                }
                echo htmlspecialchars($bottomText);
                ?>
            </span>
        </div>
</div>

</body>
</html>