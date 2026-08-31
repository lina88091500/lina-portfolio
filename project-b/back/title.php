<div class="di back-center-panel">
    <!--後台頂部導覽區-->
    <table width="100%" style="margin-bottom:10px;">
        <tbody>
            <tr>
                <td style="width:72%; font-weight:600; text-align:center; padding:6px; background:var(--j-sakura); border-radius:10px; border:1px solid var(--j-pink-accent);">
                    <a href="?do=title" style="color:var(--j-primary-dark); text-decoration:none; font-size:14px;">🌸 品牌網頁與視覺管理中心 (Admin Control Panel)</a>
                </td>
                <td style="text-align:right;">
                    <button onclick="location.replace('index.php?do=login')" style="padding:8px 16px; font-size:12.5px;">🔐 管理員登出 Log out</button>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="width:100%; height:460px; margin:auto; overflow:auto; border:1px solid var(--j-pink-accent); border-radius:14px; padding:12px; background:#FFFDF9; box-sizing:border-box;">
        <p class="t cent botli" style="font-size:15px;">🌸 網站 Header 標題與視覺圖片管理</p>
        <form method="post" action="./api/edit.php?table=<?= $do ?>">
            <table width="100%" style="table-layout:fixed; word-wrap:break-word;">
                <tbody>
                    <tr class="yel">
                        <td width="42%">標題圖片 (Header Image)</td>
                        <td width="24%">替代文字 Tagline</td>
                        <td width="9%">顯示</td>
                        <td width="9%">刪除</td>
                        <td width="16%">操作</td>
                    </tr>
                    <?php 
                    $db=${ucfirst($do)};
                    $rows=$db->all();
                    if(empty($rows)){
                        $rows = [
                            ['id'=>1, 'img'=>'header_jbeauty_v2.png', 'text'=>'Bloom Aesthetic Studio - 日本精緻美妝與美學誌', 'sh'=>1]
                        ];
                    }
                    foreach($rows as $row):
                        $rowImage = (!empty($row['img']) && file_exists("upload/" . $row['img'])) ? $row['img'] : 'header_jbeauty_v2.png';
                    ?>
                    <tr>
                        <td width="42%" class="cent">
                            <img src="./upload/<?= htmlspecialchars($rowImage); ?>" style="width:230px; height:36px; object-fit:cover; border-radius:6px; border:1px solid var(--j-pink-accent);">
                        </td>
                        <td width="24%">
                            <input type="text" name="text[]" value="<?= htmlspecialchars($row['text']); ?>" style="width:95%;">
                        </td>
                        <td width="9%" class="cent">
                            <input type="radio" name="sh" value="<?= $row['id']; ?>" <?= ($row['sh']==1)?'checked':''; ?> >
                        </td>
                        <td width="9%" class="cent">
                            <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
                        </td>
                        <td width="16%" class="cent">
                            <input type="button" value="更新圖片" onclick="op('#cover','#cvr','include/update_<?= $do; ?>.php?id=<?= $row['id'];?>')" style="padding:4px 8px; font-size:11.5px;">
                        </td>
                        <input type="hidden" name="id[]" value="<?= $row['id']; ?>">
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <table style="margin-top:20px; width:100%;">
                <tbody>
                    <tr>
                        <td width="40%">
                            <input type="button" onclick="op('#cover','#cvr','include/<?= $do; ?>.php')" value="➕ 新增標題圖片" style="padding:6px 14px;">
                        </td>
                        <td class="cent" width="60%">
                            <input type="submit" value="修改確定 Save" style="padding:6px 20px;">
                            <input type="reset" value="重置 Reset" style="background:#FFFDF9; border-color:#8C7075; color:#8C7075; padding:6px 16px;">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>