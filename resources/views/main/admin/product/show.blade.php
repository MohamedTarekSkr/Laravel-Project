<div class="container"> <div class="outer-card"> <div class="first-row"> <div class="card"></div> <img src="{{asset('storage/'.$product['image'])}}"> </div> <div class="second-row"> <h3>{{$product['name']}}</h3> <div class="space"> <span>Category</span> <span>{{$product['category']['name']}}</span> </div> <div class="space"> <span>Description</span> <span>{{$product['description']}}</span> </div> <div class="space"> <span>price</span> <span>{{'$'.$product['price']}}</span> </div> <div class="space"> <span>Discount</span> <span>{{$product['discount'].'%'}}</span> </div><div class="space"> <span>Is recent ? </span> <span>{{$product['is_recent']?'Yes':'No'}}</span> </div> <div class="space"> <span>Is featured ? </span> <span>{{$product['is_featured']?'Yes':'No'}}</span> </div><div class="space"> <span>Color </span> <span>{{$product['color']['name']}}</span> </div><div class="space"> <span>Size </span> <span>{{$product['size']['name']}}</span> </div></div> 
</div>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

* {
    margin: 0;
    padding: 0
}

.container {
    background-image: linear-gradient(to right top, #f6e017, #181718);
    min-height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center
}

.outer-card {
    height: 800px;
    width: 800px;
    background-color: rgb(86, 80, 80);
    border-radius: 10px;
    font-family: 'Poppins', sans-serif;
    overflow: hidden
}

.first-row {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    padding: 20px;
    margin-top: 20px
}

.first-row .card {
    height: 400px;
    width: 100%;
    background-image: linear-gradient(to right bottom, #000000, #ffdd00);
    border-radius: 10px;
    border-top-left-radius: 80px;
    transition:all 1s;
}

.first-row img {
    height: 350px;
    width: 350px;
    position: absolute;
    top: 20px;
    margin-top: 12px
    border-radius: 10px;
}

.second-row {
    text-align: left;
    padding-left: 20px;
    font-size:20px;
}

.second-row h3 {
    font-size: 50px
}

.space {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-right: 20px
}



.space span:nth-child(1) {
    color: rgb(243, 220, 9)
}
.third-row {
    display: flex;
    justify-content: start;
    align-items: center;
    padding-left: 19px
}


    </style>