<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                </tr>
            </thead>
            <tbody>
            @for ($hour = 8; $hour <= 18; $hour++)
                <tr>
                    <td>{{ $hour }}:00</td>
                    @for ($day = 1; $day <= 7; $day++)
                    
                        <td class="schedule-cell" data-hour="{{ $hour }}" data-day="{{ $day }}">
                            {{ $event ? $event->title : '' }} {{$day}} {{$hour}}
                        </td>
                    @endfor
                </tr>
            @endfor

            <!-- @php
                            $event = $eve->first(function($event) use ($day, $hour) {
                                return $event->day == $day && $event->hour == $hour;
                            });
                        @endphp -->
         
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="eventForm">
                        <div class="form-group">
                            <label for="eventTitle">Event Title</label>
                            <input type="text" class="form-control" id="eventTitle" required>
                        </div>
                        <input type="hidden" id="eventDay">
                        <input type="hidden" id="eventHour">
                        <button type="submit" class="btn btn-primary">Save Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Include Axios via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.schedule-cell').on('click', function() {
                var day = $(this).data('day');
                var hour = $(this).data('hour');
                $('#eventDay').val(day);
                $('#eventHour').val(hour);
                $('#eventModal').modal('show');
            });

            $('#eventForm').on('submit', function(e) {
                e.preventDefault();
                var title = $('#eventTitle').val();
                var day = $('#eventDay').val();
                var hour = $('#eventHour').val();

                $.ajax({
                    url: '{{ route('events.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        title: title,
                        day: day,
                        hour: hour
                    },
                    success: function(response) {
                        if (response.success) {
                            $('td[data-day="' + day + '"][data-hour="' + hour + '"]').text(title);
                            $('#eventModal').modal('hide');
                            $('#eventForm')[0].reset();
                        } else {
                            alert('Error saving event');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
