<div style="min-height:630px; height:auto; border:1px solid var(--j-border); border-radius:16px; width:100%; margin:0; background:rgba(255,255,255,0.85); box-shadow:var(--j-shadow-sm); padding:10px; box-sizing:border-box;">

    <!--跑馬燈滾動公告-->
    <?php include "include/marquee.php"; ?>

    <!--中央 J-Beauty 視覺展演輪播 Slider-->
    <div style="width:100%; padding:2px; height:300px; margin-top:8px; position:relative; box-sizing:border-box;">
        <div id="mwww" loop="true" style="width:100%; height:100%; border-radius:14px; overflow:hidden; border:1px solid var(--j-pink-accent); box-shadow:var(--j-shadow-sm); position:relative;">
            <img id="heroSlideImg" src="upload/hero_jbeauty_v2.png" style="width:100%; height:100%; object-fit:cover; transition:opacity 0.5s ease;" alt="J-Beauty Hero Showcase">
            
            <div style="position:absolute; bottom:12px; left:12px; background:rgba(255,255,255,0.9); backdrop-filter:blur(6px); border:1px solid var(--j-pink-accent); border-radius:20px; padding:4px 12px; font-size:11.5px; color:var(--j-primary); font-weight:600;">
                ✨ 2026 春季極光系列首獎
            </div>
        </div>
    </div>

    <script>
    var lin = [];
    <?php 
    $mvs = [];
    if (isset($Mvim)) {
        $mvs = $Mvim->all(['sh'=>1]);
    }
    if (!empty($mvs)) {
        foreach($mvs as $mv){
            echo "lin.push('upload/{$mv['img']}');\n";
        }
    } else {
        echo "lin.push('upload/hero_jbeauty_v2.png');\n";
        echo "lin.push('upload/gallery_jbeauty_v2.png');\n";
        echo "lin.push('upload/header_jbeauty_v2.png');\n";
    }
    ?>
    var now = 0;
    function ww() {
        if (lin.length > 0) {
            $("#heroSlideImg").css("opacity", "0.3");
            setTimeout(function(){
                $("#heroSlideImg").attr("src", lin[now]).css("opacity", "1");
            }, 250);
            now++;
            if (now >= lin.length) now = 0;
        }
    }
    if (lin.length > 1) {
        setInterval("ww()", 3500);
    }
    </script>

    <!--美粧情報 & 趨勢專欄區-->
    <div style="width:100%; height:auto; margin:8px 0 0 0; padding:10px 14px; border:1px solid var(--j-pink-accent); border-radius:14px; background:#FFFDF9; position:relative; box-shadow:var(--j-shadow-sm); box-sizing:border-box;">
        <span class="t botli" style="text-align:left; font-size:14px; display:flex; justify-content:space-between; align-items:center;">
            <span>🌸 美粧情報 & 專欄趨勢</span>
            <a href="?do=news" style="float:right; font-size:12px; color:var(--j-primary); text-decoration:none; font-weight:normal;">
                檢視更多 More →
            </a>
        </span>

        <?php 
        $news = [];
        if (isset($News)) {
            $news = $News->all(['sh'=>1], " limit 5");
        }
        if (empty($news)) {
            $news = [
                ['text' => '教師研習「世界公民生命園丁國內研習會」 1.主辦單位：世界展望會 2.研習日期：101年11月14日（三）～15日（四） 3.詳情請參考：http://gc.worldvision.org.tw/seed.html。請線上報名。'],
                ['text' => '公告綜合高中一年級英數補救教學時間 上課日期:10/27.11/03.11/10.11/17.11/24.12/01共六次 每次三節課 詳情請見附件。'],
                ['text' => '102年全國大專校院運動會「主題標語及吉祥物命名」網路票選活動，請踴躍參加！'],
                ['text' => '台灣亞洲藝術文化教育交流學會第一屆年會國際研討會 活動日期：101年12月15日（六）地點：國立台灣藝術大學教研大樓。'],
                ['text' => '11月23日(星期五)將於彰化縣田尾鄉菁芳園休閒農場 舉辦「高級中等學校農業類科學生職涯發展講座」歡迎報名參加。']
            ];
        }
        ?>

        <ol class="ssaa" style="padding-left:22px; margin-top:6px; margin-bottom:4px;">
            <?php foreach($news as $n): ?>
            <li onclick="openMainNewsModal(this)" style="padding:4px 0; border-bottom:1px dashed var(--j-pink-accent); cursor:pointer; font-size:12.5px; color:var(--j-primary-dark); position:relative; transition:color 0.2s;" onmouseover="this.style.color='var(--j-primary)'" onmouseout="this.style.color='var(--j-primary-dark)'">
                <span><?= mb_substr($n['text'], 0, 32); ?><?= (mb_strlen($n['text'])>32)?'...':''; ?></span>
                <div class="all" style="display:none"><?= htmlspecialchars($n['text']); ?></div>
            </li>
            <?php endforeach; ?>
        </ol>
    </div>

    <!-- 🌸 首頁獨立彈出小視窗 Modal (預設隱藏) -->
    <div id="mainNewsModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(74, 53, 58, 0.45); backdrop-filter:blur(6px); z-index:999999; align-items:center; justify-content:center;">
        <div style="background:#FFFDF9; border:1px solid var(--j-pink-accent); border-radius:20px; width:520px; max-width:90%; padding:24px; box-shadow:var(--j-shadow-lg); position:relative; animation: modalFadeIn 0.25s ease;">
            <span style="font-weight:700; color:var(--j-primary); font-size:15px; display:block; border-bottom:2px solid var(--j-pink-accent); padding-bottom:8px; margin-bottom:14px;">
                🌸 美學情報詳細內容
            </span>
            <div id="mainModalContent" style="font-size:13.5px; color:var(--j-primary-dark); line-height:1.7; word-break:break-all; max-height:300px; overflow-y:auto; padding-right:6px;">
                <!-- 內容會由 JS 自動帶入 -->
            </div>
            <div style="text-align:center; margin-top:20px;">
                <button type="button" onclick="closeMainNewsModal()" style="padding:6px 24px; border-radius:20px; background:linear-gradient(135deg, var(--j-sakura) 0%, var(--j-pink-accent) 100%); color:var(--j-primary-dark); border:1px solid var(--j-pink-accent); font-weight:600; cursor:pointer;">
                    關閉視窗 Close
                </button>
            </div>
        </div>
    </div>

    <script>
    function openMainNewsModal(el) {
        var fullContent = $(el).find(".all").text() || $(el).text();
        $("#mainModalContent").text(fullContent);
        $("#mainNewsModal").css("display", "flex").hide().fadeIn(200);
    }

    function closeMainNewsModal() {
        $("#mainNewsModal").fadeOut(150);
    }

    $("#mainNewsModal").on("click", function(e) {
        if (e.target === this) {
            closeMainNewsModal();
        }
    });
    </script>

</div>