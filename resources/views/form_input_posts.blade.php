@extends('main')
@section('title','Input Posts')
@section('content')
<form id="postFormx" method="post">
    @csrf
    <div>
        <label class="label-form">TITLE</label>
        <div class="input-field"><input class="input-field2" type="text" name="title" id="title"></div>
    </div>
    <div>
        <label class="label-form">AUTHORS</label>
        <div class="input-field"><input class="input-field2" type="text" name="authors" id="authors"></div>
    </div>
    <div>
        <label class="label-form">PUBLISH DATE</label>
        <div class="input-field"><input class="input-field2" type="date" name="publishdate" id="publishdate"></div>
    </div>
    <div>
        <label class="label-form">PUBLISH ACTIVE</label>
        <div class="input-field">
            <select class="input-field2" name="publishactive" id="publishactive">
                <option value="1">Aktif</option>
                <option value="2">Tidak Aktif</option>
            </select>
        </div>
    </div>
    <div>
        <label class="label-form">CONTENT</label>
        <div class="input-field"><textarea class="input-field2" name="content" id="content" cols="30" rows="8"></textarea></div>
    </div>
    <div>
        <label class="label-form">CATEGORY</label>
        <div class="input-field">
            <select class="input-field2" name="idcategory" id="idcategory">
                @foreach ($category as $item)
                <option value="{{ $item['category_id'] }}">{{ $item['category_name'] }}</option>
                @endforeach
            </select>                
        </div>
    </div>
    <div class="input-field">
        <button type="submit">Simpan</button>
    </div>

    <div id="message"></div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#postForm').submit(function(e) {
            e.preventDefault(); // Mencegah reload halaman

            let title = $('#title').val();
            let authors = $('#authors').val();
            let publishdate = $('#publishdate').val();
            let publishactive = $('#publishactive').val();
            let content = $('#content').val();
            let idcategory = $('#idcategory').val();

            $.ajax({
                url: "{{ url('/api/storeposts') }}", // API Endpoint
                type: "POST",
                data: JSON.stringify({ 
                    title: title, 
                    authors: authors,
                    publishdate: publishdate,
                    publishactive: publishactive,
                    content: content,
                    idcategory: idcategory
                }),
                contentType: "application/json",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}" // Jika menggunakan CSRF untuk form biasa
                },
                success: function(response) {
                    $('#message').html('<p style="color:green;">' + response.status + '</p>');
                    $('#postForm')[0].reset(); // Reset form setelah berhasil
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '<p style="color:red;">Gagal menyimpan data:</p><ul>';
                    $.each(errors, function(key, value) {
                        errorMessage += '<li>' + value[0] + '</li>';
                    });
                    errorMessage += '</ul>';
                    $('#message').html(errorMessage);
                }
            });
        });
    });
</script>
@endsection