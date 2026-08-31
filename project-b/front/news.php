<div style="height:540px; border:1px solid var(--j-border); border-radius:16px; width:100%; margin:0; background:rgba(255,255,255,0.85); box-shadow:var(--j-shadow-sm); padding:10px; box-sizing:border-box;">
    <?php include "include/marquee.php";?>
    <div style="height:20px; display:block;"></div>
    
    <div style="padding:10px 15px; position:relative;">
        <span class="t botli" style="text-align:left; font-size:15px;">🌸 日系美粧專欄 & 全站情報列表</span>
        
        <?php 
        $all = 0;
        $div = 5;
        $pages = 1;
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;
        $rows = [];

        if (isset($News)) {
            $all = $News->count(['sh'=>1]);
            if ($all > 0) {
                $pages = ceil($all / $div);
                $rows = $News->all(['sh'=>1], " limit $start,$div");
            }
        }
        
        if (empty($rows)) {
            $allRows = [
                ['text' => '【季節保養】春季換季肌膚穩定儀式：日系水光精華水使用全攻略。採用天然植物萃取成分，專為敏弱肌量身打造。'],
                ['text' => '【彩妝趨勢】2026 輕透零粉感底妝技巧，展現日本女性最愛的自然水潤透明感。只需兩步驟即可打亮好氣色。'],
                ['text' => '【美學誌】從內而外綻放光彩，日式「極簡無負擔」肌膚哲學解析。減法保養給予肌膚真正所需的養分。'],
                ['text' => '【新品體驗】櫻花限量版水感亮彩唇膏試色開箱特輯。滑順包覆唇紋，展現櫻花般自然嫩粉感。'],
                ['text' => '【肌膚檢測】Bloom Aesthetic 專屬線上肌膚分析服務上線！免費預約個人化修護方案。']
            ];
            $all = count($allRows);
            $pages = ceil($all / $div);
            $rows = array_slice($allRows, $start, $div);
        }
        ?>
        
        <ol start="<?= $start + 1; ?>" style="padding-left:20px; margin-top:15px;">
        <?php foreach($rows as $row): ?>
            <li class="sswww" onclick="showNewsDetail(this)" style="padding:8px 0; border-bottom:1px dashed var(--j-pink-accent); cursor:pointer; color:var(--j-primary-dark); font-size:13.5px; transition:all 0.2s; position:relative;">
                <?= mb_substr($row['text'], 0, 32); ?><?= (mb_strlen($row['text']) > 32) ? '...' : ''; ?>
                <div class="all" style="display:none"><?= htmlspecialchars($row['text']); ?></div>
            </li>
        <?php endforeach;?>
        </ol>

        <!--分頁導航-->
        <div class="cent" style="margin-top:25px;">
            <?php
            if ($now - 1 > 0) {
                $prev = $now - 1;
                echo "<a class='bl' href='?do=$do&p=$prev' style='margin:0 5px;'> ‹ 上頁 </a>";
            }

            for ($i = 1; $i <= $pages; $i++) {
                $style = ($i == $now) ? 'font-weight:bold; color:var(--j-primary); text-decoration:underline; font-size:16px;' : 'color:var(--j-text-muted); font-size:14px;';
                echo "<a href='?do=$do&p=$i' style='margin:0 6px; $style'> $i </a>";
            }

            if ($now + 1 <= $pages) {
                $next = $now + 1;
                echo "<a class='bl' href='?do=$do&p=$next' style='margin:0 5px;'> 下頁 › </a>";
            }
            ?>
        </div>  

        <!-- Hover 浮動情報卡片 -->
        <div id="alt"></div>

        <script>
        $(".sswww").hover(
            function () {
                var content = $(this).find(".all").text() || $(this).text();
                var pos = $(this).position();
                var topPos = pos.top - 60;
                if (topPos < 0) topPos = 10;
                $("#alt").html("<div style='font-weight:600; color:var(--j-primary); margin-bottom:6px;'>🌸 美學情報詳細內容 (點擊檢視完整內容)</div>" + content)
                         .css({"top": topPos + "px", "left": "40px"})
                         .stop(true, true).fadeIn(150);
            },
            function() {
                $("#alt").stop(true, true).fadeOut(150);
            }
        );
        </script>
    </div>
</div>