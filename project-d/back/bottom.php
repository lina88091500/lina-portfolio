<div class="di back-center-panel">
    <!--後台頂部導覽區-->
    <table width="100%" style="margin-bottom:10px;">
        <tbody>
            <tr>
                <td style="width:72%; font-weight:600; text-align:center; padding:6px; background:var(--j-sakura); border-radius:10px; border:1px solid var(--j-pink-accent);">
                    <a href="?do=admin" style="color:var(--j-primary-dark); text-decoration:none; font-size:14px;">🌸 品牌網頁與視覺管理中心 (Admin Control Panel)</a>
                </td>
                <td style="text-align:right;">
                    <button onclick="location.href='admin.php?do=logout'" style="padding:8px 16px; font-size:12.5px;">🔐 管理員登出 Log out</button>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="width:100%; height:460px; margin:auto; overflow:auto; border:1px solid var(--j-pink-accent); border-radius:14px; padding:12px; background:#FFFDF9; box-sizing:border-box;">
        <p class="t cent botli" style="font-size:15px;">🌸 頁尾版權宣告資料管理</p>
        <form method="post" action="./api/edit_value.php?table=<?= $do ?>">
            <input type="hidden" name="id" value="1">
            <table width="100%" style="margin-top:40px;">
                <tbody>
                    <tr>
                        <td width="35%" class="cent" style="font-weight:600; color:var(--j-primary-dark);">
                            頁尾版權資料內容：
                        </td>
                        <td width="65%">
                            <?php 
                            $bottomVal = "© 2026 Bloom Aesthetic Studio. All Rights Reserved. 專屬日系美妝美學作品集";
                            if (isset($Bottom)) {
                                $bData = $Bottom->find(1);
                                if (!empty($bData['bottom'])) $bottomVal = $bData['bottom'];
                            }
                            ?>
                            <input type="text" name="bottom" value="<?= htmlspecialchars($bottomVal); ?>" style="width:92%; padding:8px; border:1px solid var(--j-pink-accent); border-radius:8px;">
                        </td>
                    </tr>
                </tbody>
            </table>

            <table style="margin-top:50px; width:100%;">
                <tbody>
                    <tr>
                        <td class="cent">
                            <input type="submit" value="修改確定 Save" style="padding:8px 24px;">
                            <input type="reset" value="重置 Reset" style="background:#FFFDF9; border-color:#8C7075; color:#8C7075; padding:8px 20px;">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>