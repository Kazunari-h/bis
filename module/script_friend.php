<script type="text/javascript">
    function kakunin(){
        ret = confirm("フレンドに追加します。宜しいですか？");
        if (ret == true){
            location.href = "add_friend.php?my_id=<?php echo $user_id; ?>&your_id=<?php echo $friend_data; ?>";
        }
    }
</script>
