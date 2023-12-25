<form action="{{route('daftar.store',['id'=>md5($head->id)])}}" method="post">                                                                       
  @csrf           
  <div class="px-5">
      <div class="divider divider-center">
          <div class="divider-text">Identitas</div>
      </div>
      <div class="form-group row mb-3">
          <label class="col-md-3">Alamat</label>
          <div class="col-md-6">
            <textarea class="form-control" rows="3" name="alamat">{{old('alamat')}}</textarea>              
              @error('alamat')<div class='small text-danger text-left'>{{$message}}</div>@enderror
          </div>
      </div>
      <div class="form-group row mb-3">
        <label class="col-md-3">Jenis Kelamin</label>
        <div class="col-md-6">
            <select class="form-control" name="gender">
              <option value="1">Perempuan</option>
              <option value="2">Laki-laki</option>
            </select>
            @error('gender')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>
      <div class="form-group row mb-3">
          <label class="col-md-3">Tempat lahir</label>
          <div class="col-md-6">
              <input type="text" name="place_birth" value="{{old('place_birth')}}"   class="form-control">
              @error('place_birth')<div class='small text-danger text-left'>{{$message}}</div>@enderror
          </div>
      </div>
      <div class="form-group row mb-3">
          <label class="col-md-3">Tanggal lahir</label>
          <div class="col-md-6">
              <input type="date" name="date_birth" value="{{old('date_birth')}}"   class="form-control">
              @error('date_birth')<div class='small text-danger text-left'>{{$message}}</div>@enderror
          </div>
      </div>      
      <div class="form-group row mb-3">
        <label class="col-md-3">Agama</label>
        <div class="col-md-6">
            <select class="form-control" name="religion">
              <option value="1">Islam</option>
              <option value="2">Kristen</option>
              <option value="3">Hindu</option>
              <option value="4">Buddha</option>
              <option value="5">Konghucu</option>
            </select>
            @error('gender')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Status</label>
        <div class="col-md-6">
            <select class="form-control" name="married">
              <option value="1">Menikah</option>
              <option value="0">Belum Menikah</option>
            </select>
            @error('married')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>
    
      <div class="form-group row mb-3">
          <label class="col-md-3">Tinggi Badan</label>
          <div class="col-md-6">
              <input type="number" name="tall" value="{{old('tall')}}"   class="form-control">
              @error('tall')<div class='small text-danger text-left'>{{$message}}</div>@enderror
          </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Berat Badan</label>
        <div class="col-md-6">
            <input type="number" name="weight" value="{{old('weight')}}"   class="form-control">
            @error('weight')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Golongan Darah</label>
        <div class="col-md-6">
            <input type="text" name="blood" value="{{old('blood')}}"   class="form-control">
            @error('blood')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Hobbi</label>
        <div class="col-md-6">
            <input type="text" name="hobbies" value="{{old('hobbies')}}"   class="form-control">
            @error('hobbies')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>

      {{-- family --}}
      <div class="divider divider-center my-3">
        <div class="divider-text">Keluarga</div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Ayah</label>
        <div class="col-md-3">
            <input type="text" name="dad" value="{{old('dad')}}"   class="form-control" placeholder="Nama">
            @error('dad')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
        <div class="col-md-3">
          <input type="number" name="ageDad" value="{{old('ageDad')}}"   class="form-control" placeholder="Umur">
          @error('ageDad')<div class='small text-danger text-left'>{{$message}}</div>@enderror
      </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Ibu</label>
        <div class="col-md-3">
            <input type="text" name="mom" value="{{old('mom')}}"   class="form-control" placeholder="Nama">
            @error('mom')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
        <div class="col-md-3">
          <input type="number" name="ageMom" value="{{old('ageMom')}}"   class="form-control" placeholder="Umur">
          @error('ageMom')<div class='small text-danger text-left'>{{$message}}</div>@enderror
      </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Kakak</label>
        <div class="col-md-3">
            <input type="text" name="bro" value="{{old('bro')}}"   class="form-control" placeholder="Nama">
            @error('bro')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
        <div class="col-md-3">
          <input type="number" name="ageBro" value="{{old('ageBro')}}"   class="form-control" placeholder="Umur">
          @error('ageBro')<div class='small text-danger text-left'>{{$message}}</div>@enderror
      </div>
      </div>


      <div class="form-group row mb-3">
        <label class="col-md-3">Adik</label>
        <div class="col-md-3">
            <input type="text" name="sis" value="{{old('sis')}}"   class="form-control" placeholder="Nama">
            @error('sis')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
        <div class="col-md-3">
          <input type="number" name="ageSis" value="{{old('ageSis')}}"   class="form-control" placeholder="Umur">
          @error('ageSis')<div class='small text-danger text-left'>{{$message}}</div>@enderror
      </div>
      </div>


      <div class="divider divider-center my-3">
        <div class="divider-text">Pendidikan</div>
      </div>      
      <label class="my-3">Riwayat Pendiikan</label>
      @for ($i = 0; $i < 5; $i++)          
      <div class="form-group row mb-3">
        <label class="col-1">{{$i+1}}.</label>
        <div class="col-6">
            <input type="text" name="studied[{{$i}}]" class="form-control" placeholder="Nama Pendidikan">
            @error('studied')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
        <div class="col-5">
          <input type="number" name="perioded[{{$i}}]" class="form-control" placeholder="Periode">
          @error('perioded')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>

      </div>
      @endfor

      <div class="divider divider-center">
        <div class="divider-text">Pekerjaan</div>
      </div>
      <label class="my-3">Riwayat Pekerjaan</label>
      @for ($i = 0; $i < 5; $i++)          
      <div class="form-group row mb-3">
        <label class="col-1">{{$i+1}}.</label>
        <div class="col-3">
            <input type="text" name="job[{{$i}}]"  class="form-control" placeholder="Nama Perusahaan">     
        </div>
        <div class="col-3">
          <input type="text" name="jobPeriod[{{$i}}]" class="form-control" placeholder="Periode">
        </div>

        <div class="col-2">
          <input type="text" name="var[{{$i}}]"  class="form-control" placeholder="Jenis Pakerjaan">      
        </div>

      </div>
      @endfor

      <div class="mb-3 d-flex justify-content-start">
          <button class="btn btn-primary btn-sm rounded-pill">Save Changes</button>
      </div>
  </div>             
</form>