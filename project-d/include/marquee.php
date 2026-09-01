<div style="position:relative; width:100%; height:36px; overflow:hidden; border-radius:10px; background:linear-gradient(135deg, #F8ECEE 0%, #FFFDF9 100%); border:1px solid var(--j-pink-accent); display:flex; align-items:center; padding:0 8px; box-sizing:border-box;">
    <span style="font-size:11px; font-weight:700; background:var(--j-pink-deep); color:#FFF; padding:2px 8px; border-radius:12px; white-space:nowrap; margin-right:8px; flex-shrink:0;">NEWS</span>
    <marquee scrolldelay="110" direction="left" style="width:100%; font-size:13px; color:var(--j-primary-dark); line-height:36px;">
        <?php 
        $ads = [];
        if (isset($Ad)) {
            $ads = $Ad->all(['sh'=>1]);
        }
        if (!empty($ads)) {
            foreach($ads as $ad){
                echo "&nbsp;&nbsp;🌸 ";
                echo htmlspecialchars($ad['text']);
                echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
            }
        } else {
            echo "🌸 2026 春季「櫻花光采亮澤系列」限量全新上市！預約尊榮肌膚檢測享奢華好禮 &nbsp;&nbsp;|&nbsp;&nbsp; 🌸 日本極致透亮保養美學";
        }
        ?>
    </marquee>
</div>