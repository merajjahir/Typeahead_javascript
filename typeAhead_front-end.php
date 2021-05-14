<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PHP Live MySQL Database Search</title>
<style>
    body{
        font-family: Arail, sans-serif;
    }
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>
<script>
    
document.addEventListener("DOMContentLoaded",() => {
    let input = document.getElementById('input');
    let sibling_id = document.getElementById("sibling");

    input.addEventListener('keyup',async ()  => 
    {

        //assing the sibling to the reslut variable
        let result_that_drops = document.getElementById("input").nextElementSibling;
        result_that_drops.classList = "result";

        /* Get input value on change */
        let inputVal = input.value;



        if(inputVal.length)
        {



            if(inputVal.length > 0)
            {
                                           
                let pligrim  = await fetch("server.php",  //the php file 
                                    {
                                        method:"POST",
                                        //the "Choice_date is just a parameter name you can give it any name you want

                                        body:new URLSearchParams(`Choice_date=${inputVal}`)
                                    }); 

                let pilgrim_peer = await pligrim.text();
                result_that_drops.innerHTML = pilgrim_peer;
                
            }
            else{
                console.log("NOT BEEN ABLE TO CONNECT TO THE SERVER");
            }

           
        } else{

            result_that_drops.innerHTML = "";
        }
    });
    
    // Set search input value on click of result item
    sibling_id.addEventListener("click",()=>
    {
        //selecting the p tag of the suggestion box/the class result 
        let sibling_p = document.querySelector("#sibling > p");
        let child_nodes = sibling_id.parentElement.childNodes;

            
        //getting all the childnodes and iterating through them 
        
        child_nodes.forEach( a_child => 
            {
                if(a_child == input)
                {
                    a_child.value = sibling_p.textContent;
                    sibling_id.innerHTML="";
                }
            });
        
    })
});
</script>
</head>
<body>
    <div class="search-box">
        <input type="text" id="input" autocomplete="off" placeholder="Search country..." />
        <div id="sibling" class="result"></div>
    </div>
</body>
</html>