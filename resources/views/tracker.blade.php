

@extends('layouts.app')
@section('title','Period Tracker')


@section('content')

    <div class="container">

        {{-- Popup Predicted Date
        -------------------------------------------------------- --}}
        <div class="popup">
            <h5>Your Predicted date is : <span class="show-date"></span></h5>
        </div>

        {{-- Form
        -------------------------------------------------------- --}}
        <form enctype="multipart/form-data" class="border">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mx-auto">
                    
                    <legend>Period Tracker</legend>

                    {{-- Input Fields
                    -------------------------------------------------------- --}}
                    <div class="form-group">
                        <label for="p-startdate">Period start date:</label>
                        <input type="date" class="form-control" id="p-startdate" name="p-startdate">
                    </div>

                    <div class="form-group">
                        <label for="flowdays">Total Flow day:</label>
                        <input type="number" class="form-control" id="flowdays" name="flowdays">
                    </div>

                    <div class="result-date form-group">
                        <label>Your Predicted date is : <span class="show-date"></span></label>
                    </div>

                    {{-- Submit button
                    -------------------------------------------------------- --}}
                    <div class="form-group">
                        <button id="track" class="btn btn-primary mx-auto">Track</button>
                        <button type="submit" id="submit" class="btn btn-primary mx-auto">Save Prediction</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    
@endsection




@section('css')
    <style>
        .result-date {
            display: none;
        }
        .result-date .show-date{
            color: #e91e63;
        }
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 500px;
            margin-top: -31.5px;
            margin-left: -250px;
            padding: 29px 20px 20px 20px;
            background: #e91e63;
            color: #fff;
            border-radius: 20px;
            box-shadow: 0px 1px 12px 1px #e91e63a8; 
            display: none;
            text-align: center;
        }
    </style>
@endsection

@section('script')
    <script>

        $(document).ready(function () {

            // Defining global variable  ----------------------------------
            var period_startdate;
            var total_flowdays;
            var total_days;
            var finaldate;

            var popup = $('.popup');
            var result_date = $('.result-date');
            var show_date = $('.show-date');

            // Calculate Period date on click  ----------------------------------
            $('#track').click(function (e) {
                e.preventDefault(); 
                track_period();
            });

            //Track Period function  ----------------------------------
            function track_period() {

                // Get value from Period start date input field
                period_startdate = new Date($('#p-startdate').val());

                // Get value from Total flow days input field
                total_flowdays = $('#flowdays').val();

                // Covert string to integer
                total_flowdays = parseInt(total_flowdays, 10);
                
                // Adding total flowday to 1 period cycle
                total_days = total_flowdays + 28;

                // Set final date after adding total days
                period_startdate.setDate(period_startdate.getDate() + total_days);

                //Convert date format to dd-mm-yy & store in finaldate variable
                finaldate = period_startdate.toInputFormat();

                //Send final date inside popup / result date label
                show_date.text(finaldate);

                //Show popup $ result date DIV
                // popup.fadeIn();
                result_date.show();

                setTimeout(() => {
                     popup.fadeOut();
                    //  result_date.fadeOut();
                }, 3000);
                
            }


            // FUNCTION -- change date to dd-mm-yyy format  ----------------------------------
            Date.prototype.toInputFormat = function() {
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
            var dd  = this.getDate().toString();
            return (dd[1]?dd:"0"+dd[0]) + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + yyyy; // padding
            };

        });
        
    </script>
@endsection