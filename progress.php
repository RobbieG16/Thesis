<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Step Progress Bar</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
    <div class="main">

        <ul>
            <li>
                <i class="icon uil uil-capture"></i>
                <div class="progress one">
                    <p>1</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Data Retrieval</p>
            </li>
            <li>
                <i class="icon uil uil-clipboard-notes"></i>
                <div class="progress two">
                    <p>2</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Model Loading</p>
            </li>
            <li>
                <i class="icon uil uil-credit-card"></i>
                <div class="progress three">
                    <p>3</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Sensor Reading Prediction</p>
            </li>
            <li>
                <i class="icon uil uil-exchange"></i>
                <div class="progress four">
                    <p>4</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Database Update</p>
            </li>
            <li>
                <i class="icon uil uil-map-marker"></i>
                <div class="progress five">
                    <p>5</p>
                    <i class="uil uil-check"></i>
                </div>
                <p class="text">Process Complete</p>
            </li>
        </ul>

    </div>

    <!-- <script src="main.js"></script> -->
</body>
</html>

<style>

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
@font-face {
    font-family: pop;
    src: url(./Fonts/Poppins-Medium.ttf);
}

.main{
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: pop;
    flex-direction: column;
}
.head{
    text-align: center;
}
.head_1{
    font-size: 30px;
    font-weight: 600;
    color: #333;
}
.head_1 span{
    color: #ff4732;
}
.head_2{
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-top: 3px;
}
ul{
    display: flex;
    margin-top: 80px;
}
ul li{
    list-style: none;
    display: flex;
    flex-direction: column;
    align-items: center;
}
ul li .icon{
    font-size: 35px;
    color: #ffd700;
    margin: 0 60px;
}
ul li .text{
    font-size: 14px;
    font-weight: 600;
    color: #ff4732;
}

/* Progress Div Css  */
.progress {
    background-color: #006400; /* Dark Green */
}
ul li .progress{
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: rgba(68, 68, 68, 0.781);
    margin: 14px 0;
    display: grid;
    place-items: center;
    color: #fff;
    position: relative;
    cursor: pointer;
        transition: background-color 2s ease-in-out, width 2s ease-in-out;

}
.progress::after{
    content: " ";
    position: absolute;
    width: 125px;
    height: 5px;
    background-color: rgba(68, 68, 68, 0.781);
    right: 30px;
}
.one::after{
    width: 0;
    height: 0;
}
ul li .progress .uil{
    display: none;
}
ul li .progress p{
    font-size: 13px;
    color: #ffffff; /* White */

}

.active {
    background-color: #ffd700; /* Gold */
    
}

ul li .active{
    background-color: green;
    display: grid;
    place-items: center;
}
li .active::after{
    background-color: #ffd700;
}
ul li .active p{
    display: none;
}
ul li .active .uil{
    font-size: 20px;
    display: flex;
}

/* Responsive Css  */

@media (max-width: 980px) {
    ul{
        flex-direction: column;
    }
    ul li{
        flex-direction: row;
    }
    ul li .progress{
        margin: 0 30px;
    }
    .progress::after{
        width: 5px;
        height: 55px;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: -1;
    }
    .one::after{
        height: 0;
    }
    ul li .icon{
        margin: 15px 0;
    }
}

@media (max-width:600px) {
    .head .head_1{
        font-size: 24px;
    }
    .head .head_2{
        font-size: 16px;
    }
}
.head_1, .head_2, ul li .text {
    color: #006400; /* Dark Green */
}

/* Accent Color for Highlighting */
.head_1 span, .icon, .active, .progress::after {
    color: #ffd700; /* Gold */
}
ul li .progress {
    transition: 2s ease;
}

ul li .progress::after {
    transition: 1s ease;
}

</style>
<script>
const one = document.querySelector(".one");
const two = document.querySelector(".two");
const three = document.querySelector(".three");
const four = document.querySelector(".four");
const five = document.querySelector(".five");

const progressSteps = document.querySelectorAll(".progress");
let currentStep = 0;

function activateStep(stepIndex) {
    for (let i = 0; i < progressSteps.length; i++) {
        if (i <= stepIndex) {
            progressSteps[i].classList.add("active");
        } else {
            progressSteps[i].classList.remove("active");
        }
    }
}

function autoAdvance() {
    // Increment currentStep and activate the next step with a slight delay
    currentStep = (currentStep + 1) % progressSteps.length;
    setTimeout(() => activateStep(currentStep), 100);
}

// Initial activation (optional)
activateStep(currentStep);

// Set interval to auto advance every 2 seconds
const intervalId = setInterval(autoAdvance, 2000);
</script>
