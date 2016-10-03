<?php
    /*
    * @param $page_no, actuelle side
    * @param $pages_total, totalle antal sider
    * @param $items_total, totalle antal elementer
    * @param $page_length, længde af hver side
    * @param $overall_range, range fra og til på actuelle side, standard er 2
    */
function pagination($page_no,$pages_total,$items_total,$page_length,$overall_range=2)
{
    global $icons;
    echo '<ul class="pagination">';
    $pages_total=ceil($items_total/$page_length);
    
    if($pages_total>1)
    {
        $floor=floor($pages_total);
        if($page_no==1 && $floor>0)
        {
            echo '<li class="disabled"><span>'.$icons['previous'].'</span></li>';
        } else if($pages_total>0)
        {
            echo '<li><a href="index.php?page=users&page-no='.intval($page_no-1).'" data-page="users" data-params="page-no='.intval($page_no-1).'">'.$icons['previous'].'</a></li>';
        }
        $range=$overall_range;
        $rest=0;
        /* start, vores start index i vores for løkke
        * hvis current page minus range er større end nul blir start indexed sat
        * inde i løkken bliver range minuset, og rest pluset indtil den gyldige værdi 1 er fundet
        */
        $start=($page_no - $range > 0 ? $page_no - $range : false);
        while(!$start)
        {
            $range--;
            $rest++;
            $start=($page_no - $range > 0 ? $page_no - $range : false);
        }
        $range=$overall_range;
        $rest2=0;
        /* end, skal vi ind og se på vores total pages
        * ligesom vi brugte minus før skal vi nu bruge plus, og huske vores rest!
        * så hvis current page plus range plus rest er mindre eller lig med total pages bliver end værdi sat
        * hvis den er false går den igen ind i løkken som før indtil en gyldig værdi bliver fundet
        */
        $end=($page_no + $range + $rest <= $pages_total ? $page_no + $range + $rest: false);
        while(!$end)
        {
            $range--;
            $rest2++;
            $end=($page_no + $range + $rest <= $pages_total ? $page_no + $range + $rest : false);
        }
        $start-=$rest2;
        $start=$start>0 ? $start : 1;

        if($start != 1) 
        {
            echo '<li '.($page_no==1 ? 'class="active"' : "").'><a href="index.php?page=users&page-no=1" data-page="users" data-params="page-no=1">1</a></li>';
            if($page_no - $overall_range >2)
                echo '<li class="disabled"><span>&hellip;</span></li>';
        }

        for($i=$start;$i<=$end;$i++)
        {
            echo '<li '.($page_no==$i ? 'class="active"' : "").'><a href="index.php?page=users&page-no='.$i.'" data-page="users" data-params="page-no='.$i.'">'.$i.'</a></li>';
        }

        if($end != $pages_total) {
            if($page_no + $overall_range <$pages_total-1)
                echo '<li class="disabled"><span>&hellip;</span></li>';
            echo '<li '.($page_no==$pages_total ? 'class="active"' : "").'><a href="index.php?page=users&page-no='.$pages_total.'" data-page="users" data-params="page-no='.$pages_total.'">'.$pages_total.'</a></li>';
        }
        if($page_no==$pages_total)
        {
            echo '<li class="disabled"><span>'.$icons['next'].'</span></li>';
        } else if($floor>0)
        {
            echo '<li><a href="index.php?page=users&page-no='.intval($page_no+1).'" data-page="users" data-params="page-no='.intval($page_no+1).'">'.$icons['next'].'</a></li>';
        }
    }
    echo '</ul>';
}
?>