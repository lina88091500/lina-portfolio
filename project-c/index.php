<?php 
// 載入資料庫處理庫 (若 MySQL 無法連線亦具備完美 Fallback 展演機制)
@include_once "api/db.php";
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bloom Aesthetic Studio | 日本精緻美妝與美學誌</title>
<link href="./css/css.css" rel="stylesheet" type="text/css">
<script src="./js/jquery-1.9.1.min.js"></script>
<script src="./js/js.js"></script>
<script>
// 選單次級選單 Hover 與點擊控制 (確保光滑移入與點擊次選單)
$(document).ready(function(){
    $(".mainmu").hover(
        function(){ $(this).find(".mw").stop(true, true).fadeIn(150); },
        function(){ $(this).find(".mw").stop(true, true).fadeOut(150); }
    );
});

// 前端點擊最新情報列表彈出完整內容 Modal
function showNewsDetail(el) {
    var content = $(el).find(".all").html() || $(el).text();
    $("#cvr").html(`
        <div style="padding:20px 10px;">
            <h3 style="color:var(--j-primary); font-size:16px; margin-bottom:12px; border-bottom:2px solid var(--j-pink-accent); padding-bottom:8px;">🌸 美學情報詳細內容</h3>
            <div style="font-size:14px; line-height:1.8; color:var(--j-primary-dark); white-space:pre-wrap;">${content}</div>
        </div>
    `);
    $("#cover").fadeIn(200);
}
</script>
</head>

<body class="front-page">

<?php $do = $_GET['do'] ?? 'main'; ?>
<?php include 'include/front_nav.php'; ?>

<?php
$totalCount = 12580;
if (isset($Total)) {
    $tData = $Total->find(1);
    if (!empty($tData['total'])) $totalCount = $tData['total'];
}
?>
<aside class="floating-visitor" aria-label="網站訪客人數">
    <span>VIP VISITORS</span>
    <strong>🌸 貴賓蒞臨 : <?= number_format($totalCount); ?> 人</strong>
</aside>

<div id="cover" style="display:none;">
	<div id="coverr">
    	<a style="position:absolute; right:15px; top:12px; cursor:pointer; z-index:9999; font-size:20px; color:#7E4A52;" onclick="cl('#cover')">✕</a>
        <div id="cvr" style="position:absolute; width:95%; height:90%; margin:auto; z-index:9898;"></div>
    </div>
</div>
<iframe style="display:none;" name="back" id="back"></iframe>

<div id="main">

		<!-- 🎨 個人美妝作品專屬徽章 -->
		<div class="artist-badge">
			🌸 J-BEAUTY STUDIO 專屬作品
		</div>

    	<?php 
        $titleImg = "upload/header_jbeauty_v2.png";
		$titleText = "Bloom Aesthetic Studio - 日本精緻美妝與美學誌";
		if (isset($Title)) {
			$title = $Title->find(['sh'=>1]);
			if (!empty($title['img']) && file_exists("upload/".$title['img'])) {
				$titleImg = "upload/".$title['img'];
			}
			if (!empty($title['text'])) {
				$titleText = $title['text'];
			}
		}
		?>
    	<a title="<?= htmlspecialchars($titleText); ?>" href="index.php">
			<!--頂部長方形日系美妝 Header 廣告 Banner-->
			<div class="ti" style="background-image: url('<?= $titleImg ?>');">
			</div>
		</a>
        
    	<div id="ms" class="<?= ($do === 'news') ? 'news-layout' : ''; ?>">
            <!--🔒 左側主選單欄位 (FixedWidth 215px)-->
            <div id="lf">
                <div id="menuput" class="dbor">
                    <span class="t botli">美學選單區</span>
					<?php 
					$mains = [];
					if (isset($Menu)) {
						$mains = $Menu->all(['sh'=>1, 'main_id'=>0]);
					}
					if (empty($mains)) {
						$mains = [
							['id'=>1, 'text'=>'護膚儀式 (Skincare)', 'href'=>'?do=main'],
							['id'=>2, 'text'=>'彩妝美學 (Makeup)', 'href'=>'?do=main'],
							['id'=>3, 'text'=>'季節限定 (Seasonal)', 'href'=>'?do=news'],
							['id'=>4, 'text'=>'品牌故事 (Brand Story)', 'href'=>'?do=main'],
							['id'=>5, 'text'=>'美粧專欄 (Journal)', 'href'=>'?do=news']
						];
					}
					
					foreach($mains as $main): ?>
						<div class='mainmu cent'>
							<a href="<?= $main['href'] ?>"><?= $main['text'] ?></a>
							<div class="mw">
								<?php 
								$subs = [];
								if (isset($Menu) && isset($main['id'])) {
									$subs = $Menu->all(['main_id'=>$main['id']]);
								}
								if (empty($subs) && $main['id'] == 1) {
									$subs = [
										['text'=>'光彩前導精華', 'href'=>'?do=main'],
										['text'=>'櫻花水感保濕乳', 'href'=>'?do=main']
									];
								} elseif (empty($subs) && $main['id'] == 2) {
									$subs = [
										['text'=>'無瑕光透底妝', 'href'=>'?do=main'],
										['text'=>'日系柔霧唇膏', 'href'=>'?do=main']
									];
								}
								
								foreach($subs as $sub): ?>
									<div class='mainmu2'>
										<a href="<?= $sub['href'] ?>"><?= $sub['text'] ?></a>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endforeach; ?>
                </div>
                
                <!--訪客計數卡片-->
                <div class="dbor cent" style="margin-top:10px; width:100%; height:72px; display:flex; flex-direction:column; justify-content:center; align-items:center;">
                    <?php 
                    $totalCount = 12580;
                    if (isset($Total)) {
                        $tData = $Total->find(1);
                        if (!empty($tData['total'])) $totalCount = $tData['total'];
                    }
                    ?>
                    <span class="t" style="font-size:11px; color:#8C7075; padding:0;">VIP VISITORS</span>
                    <span style="font-size:14.5px; font-weight:700; color:#7E4A52; letter-spacing:0.8px; margin-top:2px;">
                    	🌸 貴賓蒞臨 : <?= number_format($totalCount); ?> 人
                    </span>
                </div>
            </div>
            
            <!--🔒 中央主動態內容區 (FixedWidth 540px)-->
            <div class="di main-center-panel">
				<?php 
				$file = "front/$do.php";
				if (file_exists($file)) {
					include $file;
				} else {
					include "front/main.php";
				}
				?>
			</div>
            
            <!--🔒 右側美學賞析與管理區 (FixedWidth 215px)-->
            <div class="di ad right-side-panel">
                <button style="width:100%; margin:0 0 8px 0; height:42px; font-size:13px;" onclick="lo('?do=login')">
                    品牌後台管理
                </button>
                
                <div style="width:100%; height:470px; overflow:hidden;" class="dbor cent">
                    <span class="t botli">日系美學賞析</span>
                    
                    <!-- 上按鈕：強迫水平置中 -->
                    <div class="gallery-arrow-container">
                        <button type="button" class="gallery-arrow" onclick="pp(1)" aria-label="上一組圖片">▲</button>
                    </div>
                    
                    <?php 
                    $imgs = [];
                    if (isset($Image)) {
                        $imgs = $Image->all(['sh'=>1]);
                    }
                    if (empty($imgs)) {
                        $imgs = [
                            ['img' => 'gallery_jbeauty_v2.png'],
                            ['img' => 'hero_jbeauty_v2.png'],
                            ['img' => 'header_jbeauty_v2.png']
                        ];
                    }
                    foreach($imgs as $idx => $img):
                        $imgPath = "upload/" . $img['img'];
                    ?>
                        <!-- 圖片容器：預設隱藏非當前頁，防跑版爆框 -->
                        <div class="im cent" id="ssaa<?= $idx; ?>" style="display:none; margin:6px 0;">
                            <img src="<?= $imgPath; ?>" alt="J-Beauty Showcase" style="width:155px; height:98px; object-fit:cover; margin:0 auto; border-radius:12px; border:2px solid var(--j-pink-accent); box-shadow:0 4px 10px rgba(126,74,82,0.08);">
                        </div>
                    <?php endforeach; ?>
                    
                    <!-- 下按鈕：強迫水平置中 -->
                    <div class="gallery-arrow-container">
                        <button type="button" class="gallery-arrow" onclick="pp(2)" aria-label="下一組圖片">▼</button>
                    </div>

                    <script>
                    var nowpage = 0;
                    var num = <?= count($imgs); ?>;
                    function pp(x) {
                        if (x == 1 && nowpage - 1 >= 0) { nowpage--; }
                        if (x == 2 && (nowpage * 1 + 3) < num * 1) { nowpage++; }

                        $(".im").hide();

                        for (var s = 0; s <= 2; s++) {
                            var t = s * 1 + nowpage * 1;
                            $("#ssaa" + t).show();
                        }
                    }
                    pp(1);
                    </script>
                </div>
            </div>
        </div>
        
        <div style="clear:both;"></div>
        
        <!--頁尾區 Footer-->
        <div>
            <span class="t">
                © 2026 Bloom Aesthetic Studio. All Rights Reserved. 專屬日系美妝美學作品集
            </span>
        </div>
</div>

</body>
</html>