<?php
if ($pages = $this->LoadRecentlyChanged())
{
	$curday = "";
	print("<p><a href=\"".$this->href("recentchanges.xml", $this->page["tag"])."\"><img src=\"images/xml.png\" width=\"36\" height=\"14\" alt=\"XML\" /></a></p>\n");
	if ($user = $this->GetUser()) {
		$max = $user["changescount"];
	} else {
		$max = 50;
	}

	foreach ($pages as $i => $page)
	{
		if (($i < $max) || !$max)
		{
			// day header
			list($day, $time) = explode(" ", $page["time"]);
			if ($day != $curday)
			{
				$dateformatted = date("D, d M Y", strtotime($day));

				if ($curday) print("</span><br />\n");
				print("<strong>$dateformatted:</strong><br />\n<span class=\"recentchanges\">");
				$curday = $day;
			}

			$timeformatted = date("H:i T", strtotime($page["time"]));

			// print entry
			if ($page["note"]) $note=" <span class=\"pagenote\">[".$page["note"]."]</span>"; else $note ="";
			$pagetag = $page["tag"];
			if ($this->HasAccess("read", $pagetag)) {
					print("&nbsp;&nbsp;&nbsp;&nbsp;(".$this->Link($pagetag, "revisions", $timeformatted, 0, 1, "View recent revisions list for ".$pagetag).") [".$this->Link($pagetag, "history", "history", 0, 1, "View edit history of ".$pagetag)."] - &nbsp;".$this->Link($pagetag, "", "", 0)." &rArr; ".$page["user"]." ".$note."<br />");
			} else {
					print("&nbsp;&nbsp;&nbsp;&nbsp;($timeformatted) [history] - &nbsp;".$page["tag"]." &rArr; ".$page["user"]." ".$note."<br />");
			}
		}
	}
	print "</span>\n";
}
?>