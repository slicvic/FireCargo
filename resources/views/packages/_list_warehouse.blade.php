<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Type</th>
            <th>Status</th>
            <th>L x W x H</th>
            <th>Weight</th>
            <th>Shipment</th>
            <th>Tracking #</th>
            <th>Inv #</th>
            <th>Inv $</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($packages as $package)
            <tr class="{{ $package->wasShipped() ? 'success' : 'danger' }}">
                <td>{{ $package->id }}</td>
                <td>{{ $package->present()->type() }}</td>
                <td>{{ $package->present()->status() }}</td>
                <td>{{ $package->present()->dimensions() }}</td>
                <td>{{ $package->present()->weight() }}</td>
                <td>{!! $package->present()->shipmentLink() !!}</td>
                <td>{{ $package->tracking_number }}</td>
                <td>{{ $package->invoice_number }}</td>
                <td>{{ $package->present()->invoiceAmount() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
