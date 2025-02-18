<?php
	echo "<nav>";
	echo "<ul class='sidebar'>";
	echo "<li><a onclick=hideSidebar()><svg xmlns='http://www.w3.org/2000/svg' height='26px' viewBox='0 -960 960 960' width='26px' fill='#1f1f1f'><path d='m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z'/></svg></a></li>";
	echo "<li><a href='about_me.php'>About Me</a></li>";
	echo "<li><a href='projects.php'>Projects</a></li>";
	echo "<li><a href='contact.php'>Contact Me</a></li>";
	echo "</ul>";
	echo "<ul>";
	echo "<li><a href='index.html'>AndrewSchnick.ddns.net</a></li>";
	echo "<li><a href='about_me.php' class='hideOnMobile'>About Me</a></li>";
	echo "<li><a href='projects.php' class='hideOnMobile'>Projects</a></li>";
	echo "<li><a href='contact.php' class='hideOnMobile'>Contact Me</a></li>";
	echo "<li class='menu-button' onclick=showSidebar()><a><svg xmlns='http://www.w3.org/2000/svg' height='26px' viewBox='0 -960 960 960' width='26px' fill='#1f1f1f'><path d='M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z'/></svg></a></li>";
	echo "</ul>";
	echo "</nav>";
	/*echo "<script> ";
        echo "function showSidebar(){ ";
        echo " const sidebar = document.querySelector('.sidebar') ";
        echo " sidebar.style.display = 'flex' ";
        echo " } ";
	echo " function hideSidebar(){ ";
        echo " const sidebar = document.querySelector('.sidebar') ";
        echo " sidebar.style.display = 'none' ";
        echo " } ";
	echo " </script>";*/
?>
