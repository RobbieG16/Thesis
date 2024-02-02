<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Include Bootstrap JS (Make sure this comes after jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic);

        :root {
            --primary-color: #f90a39;
            --text-color: #1d1d1d;
            --bg-color: #f1f1fb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background-color: #fff;
        }

        .calendar,
        .calendar2 {
            width: 100%;
            max-width: 600px;
            padding: 30px 20px;
            border-radius: 10px;
            background-color: var(--bg-color);
            margin-bottom: 20px;
        }

        .calendar .header,
        .calendar2 .header2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #ccc;
        }

        .calendar .header .month,
        .calendar2 .header2 .month2 {
            display: flex;
            align-items: center;
            font-size: 25px;
            font-weight: 600;
            color: var(--text-color);
        }

        .calendar .header .btns,
        .calendar2 .header2 .btns2 {
            display: flex;
            gap: 10px;
        }

        .calendar .header .btns .btn,
        .calendar2 .header2 .btns2 .btn2 {
            width: 50px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            color: #fff;
            background-color: var(--primary-color);
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .calendar .header .btns .btn:hover,
        .calendar2 .header2 .btns2 .btn2:hover {
            background-color: #db0933;
            transform: scale(1.05);
        }

        .weekdays,
        .weekdays2 {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .weekdays .day,
        .weekdays2 .day2 {
            width: calc(100% / 7 - 10px);
            text-align: center;
            font-size: 16px;
            font-weight: 600;
        }

        .days,
        .days2 {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .days .day,
        .days2 .day2 {
            width: calc(100% / 7 - 10px);
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 400;
            color: var(--text-color);
            background-color: #fff;
            transition: all 0.3s;
        }

        .days .day:not(.next):not(.prev):hover,
        .days2 .day2:not(.next2):not(.prev2):hover {
            color: #fff;
            background-color: var(--primary-color);
            transform: scale(1.05);
        }

        .days .day.today,
        .days2 .day2.today2 {
            color: #fff;
            background-color: var(--primary-color);
        }

        .days .day.next,
        .days .day.prev,
        .days2 .day2.next2,
        .days2 .day2.prev2 {
            color: #ccc;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php include('sidebar.php'); ?>
            <div class="col-md-6">
                <div class="calendar">
                    <div class="header">
                        <div class="month"></div>
                        <div class="btns">
                            <div class="btn today-btn">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div class="btn prev-btn">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                            <div class="btn next-btn">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <div class="weekdays">
                        <div class="day">Sun</div>
                        <div class="day">Mon</div>
                        <div class="day">Tue</div>
                        <div class="day">Wed</div>
                        <div class="day">Thu</div>
                        <div class="day">Fri</div>
                        <div class="day">Sat</div>
                    </div>
                    <div class="days">
                        <!-- lets add days using js -->
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="calendar2">
                    <div class="header2">
                        <div class="month2"></div>
                        <div class="btns2">
                            <div class="btn today-btn2">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div class="btn prev-btn2">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                            <div class="btn next-btn2">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <div class="weekdays2">
                        <div class="day2">Sun</div>
                        <div class="day2">Mon</div>
                        <div class="day2">Tue</div>
                        <div class="day2">Wed</div>
                        <div class="day2">Thu</div>
                        <div class="day2">Fri</div>
                        <div class="day2">Sat</div>
                    </div>
                    <div class="days2">
                        <!-- lets add days using js -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="script2.js"></script>

</body>

</html>
