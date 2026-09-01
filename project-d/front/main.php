<div style="height:540px; border:1px solid var(--j-border); border-radius:16px; width:100%; margin:0; background:rgba(255,255,255,0.85); box-shadow:var(--j-shadow-sm); overflow:hidden; padding:10px; box-sizing:border-box;">

    <!--跑馬燈滾動公告 (Overflow contained)-->
    <?php include "include/marquee.php"; ?>

    <!--中央 J-Beauty 視覺展演輪播 Slider-->
    <div style="width:100%; padding:2px; height:270px; margin-top:10px; position:relative; box-sizing:border-box;">
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
    <div style="width:100%; height:180px; margin:10px 0 0 0; padding:10px 14px; border:1px solid var(--j-pink-accent); border-radius:14px; background:#FFFDF9; position:relative; box-shadow:var(--j-shadow-sm); box-sizing:border-box;">
        <span class="t botli" style="text-align:left; font-size:14px; display:flex; justify-content:space-between; align-items:center;">
            <span>🌸 美粧情報 & 專欄趨勢</span>
            <a href="?do=news" style="float:right; font-size:12px; color:var(--j-primary); text-decoration:none; font-weight:normal;">
                檢視更多 More →
            </a>
        </span>

        <ul class="ssaa" style="list-style-type:none; padding-left:0; margin-top:8px;">
            <?php 
            $news = [];
            if (isset($News)) {
                $news = $News->all(['sh'=>1], " limit 5");
            }
            if (empty($news)) {
                $news = [
                    ['text' => '【季節保養】春季換季肌膚穩定儀式：日系水光精華水使用全攻略'],
                    ['text' => '【彩妝趨勢】2026 輕透零粉感底妝技巧，展現日本女性最愛的自然水潤透明感'],
                    ['text' => '【美學誌】從內而外綻放光彩，日式「極簡無負擔」肌膚哲學解析'],
                    ['text' => '【新品體驗】櫻花限量版水感亮彩唇膏試色開箱特輯']
                ];
            }
            foreach($news as $n):
            ?>
            <li onclick="showNewsDetail(this)" style="display:flex; align-items:center; margin-bottom:4px; position:relative; cursor:pointer;">
                <span style="color:var(--j-pink-accent); margin-right:8px; font-size:10px;">✦</span>
                <span><?= mb_substr($n['text'], 0, 26); ?><?= (mb_strlen($n['text'])>26)?'...':''; ?></span>
                <div class="all" style="display:none"><?= htmlspecialchars($n['text']); ?></div>
            </li>
            <?php endforeach; ?>
        </ul>

        <!-- Hover 時出現的質感 Tooltip -->
        <div id="altt"></div>

        <script>
        $(".ssaa li").hover(
            function() {
                var content = $(this).find(".all").text() || $(this).text();
                var pos = $(this).position();
                var topPos = pos.top - 55;
                if (topPos < -30) topPos = -10;
                $("#altt").html("<div style='font-weight:600; color:var(--j-primary); margin-bottom:4px;'>🌸 美學情報詳情 (點擊檢視完整內容)</div>" + content)
                          .css({"top": topPos + "px", "left": "40px"})
                          .stop(true, true).fadeIn(150);
            },
            function() {
                $("#altt").stop(true, true).fadeOut(150);
            }
        );
        </script>
    </div>

</div>