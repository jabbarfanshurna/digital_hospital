<td>
    @foreach($r->prescriptions as $p)
        <div>
            <strong>{{ $p->obat }}</strong><br>
            {{ $p->dosis }} - {{ $p->frekuensi }} ({{ $p->durasi }})
        </div>
        <hr>
    @endforeach
</td>
