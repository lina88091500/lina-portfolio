<div style="height:540px; border:1px solid var(--j-border); border-radius:16px; width:100%; margin:0; background:rgba(255,255,255,0.85); box-shadow:var(--j-shadow-sm); padding:10px; box-sizing:border-box;">
    <?php include "include/marquee.php";?>
    <div style="height:25px; display:block;"></div>
    
    <!--美妝後台管理登入卡片-->
    <div style="width:85%; margin:40px auto; padding:25px 20px; background:#FFFDF9; border:1px solid var(--j-pink-accent); border-radius:16px; box-shadow:var(--j-shadow-md); box-sizing:border-box;">
        <form method="post" action="api/login.php">
            <span class="t botli" style="font-size:16px; margin-bottom:20px;">🌸 品牌專櫃後台管理登入</span>
            
            <p class="cent" style="margin:16px 0;">
                <label style="font-size:13px; color:var(--j-primary-dark); font-weight:500;">帳 號 ：</label>
                <input name="acc" autofocus="" type="text" placeholder="請輸入管理帳號" style="width:170px;">
            </p>
            <p class="cent" style="margin:16px 0;">
                <label style="font-size:13px; color:var(--j-primary-dark); font-weight:500;">密 碼 ：</label>
                <input name="pw" type="password" placeholder="請輸入密碼" style="width:170px;">
            </p>
            <p class="cent" style="margin-top:24px;">
                <button type="submit" style="padding:8px 24px; margin-right:10px;">確認登入 Login</button>
                <button type="reset" style="background:#FFFDF9; border-color:#8C7075; color:#8C7075; padding:8px 20px;">清除重填</button>
            </p>
        </form>
    </div>
</div>