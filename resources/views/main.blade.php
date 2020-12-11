@extends('layout')

@section('include_scripts')
<script src="https://momentjs.com/downloads/moment.min.js"></script>
@endsection

@section('content')
<div class="col-md-6">
    <div id="actions" class="d-flex justify-content-end">
        <button class="btn btn-sm btn-danger" onclick="stopSync();">
            <icon class="material-icons">sync_disabled</icon>
            Stop Sync
        </button>
    </div>

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                <icon class="material-icons">supervised_user_circle</icon>
                Today's user sync view
            </h3>
        </div>

        <div id="data" class="card-body">

        </div>
    </div>
</div>
@endsection

@section('page_script')
<script>
    var source = new EventSource('<?= url('/') ?>/live');

    source.addEventListener('open', function(e) {
        jQuery('#data').html("");
        console.log(e);
    }, false);

    source.addEventListener('message', function(e) {
        try {
            data = JSON.parse(e.data);
            console.log(data);

            data.forEach(row => {
                jQuery('#data').prepend(
                    `<div class="callout callout-info">
                        <h5>${row.username}</h5>
                        <p>${row.email} | ${row.contact} | ${moment(row.created_at).format('ddd DD MMM YYYY')}</p>
                    </div>`
                );
            });

        } catch (e) {
            console.log('Error json decodeing ');
            console.log(e);
        }
    }, false);

    source.addEventListener('error', function(e) {
        console.log(e);
    }, false);

    window.onbeforeunload = (e) => {
        source.close();
        e.returnValue = 'Sure?';
    }

    function stopSync() {
        source.close();
    }
</script>
@endsection