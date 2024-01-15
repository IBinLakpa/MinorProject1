<?php
    $id=$row["product_id"];
    $topic = $row["name"];
    $rate = $row["rate"];
    $rate = $row["category_id"];
    echo "<section>
       <h3 id=#$id><a href='post.php?post=$id'>$topic</a></h3>
       <span>-By $by</span>
       <div class='blog-content'>$content</div>
       <span>$timestamp<br>#$id</span>
    </section>";
 
?>