<h2>Danh sách svien</h2>
<ul>
    <?php foreach($students as $row): ?>
        <li>id: <?php echo $row['id']; ?>, name: <?php echo $row['name']; ?></li>
    <?php endforeach; ?>
</ul>
