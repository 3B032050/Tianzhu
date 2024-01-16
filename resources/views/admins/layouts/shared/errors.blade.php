@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
        <!-- 表單錯誤清單 -->
        <strong>錯誤 !</strong>
        <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
