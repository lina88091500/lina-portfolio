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
        <p class="t cent botli" style="font-size:15px;">🌸 美妝快訊與跑馬燈廣告管理</p>
        <form method="post" action="./api/edit.php?table=<?= $do ?>">
            <table width="100%" style="table-layout:fixed; word-wrap:break-word;">
                <tbody>
                    <tr class="yel">
                        <td width="72%">動態文字廣告內容 (Announcement Text)</td>
                        <td width="14%">顯示</td>
                        <td width="14%">刪除</td>
                    </tr>
                    <?php 
                    $db=${ucfirst($do)};
                    $rows=$db->all();
                    if(empty($rows)){
                        $rows = [
                            ['id'=>1, 'text'=>'🌸 2026 春季「櫻花光采亮澤系列」限量全新上市！預約尊榮肌膚檢測享限量奢華好禮', 'sh'=>1]
                        ];
                    }
                    foreach($rows as $row):
                    ?>
                    <tr>
                        <td width="72%">
                            <input type="text" name="text[]" value="<?= htmlspecialchars($row['text']); ?>" style="width:96%;">
                        </td>
                        <td width="14%" class="cent">
                            <input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh']==1)?'checked':''; ?>>
                        </td>
                        <td width="14%" class="cent">
                            <input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
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
                            <input type="button" onclick="op('#cover','#cvr','include/<?= $do; ?>.php')" value="➕ 新增快訊廣告" style="padding:6px 14px;">
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