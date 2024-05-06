<div class="container">
    <div class="row">

         <h1 class="text-center mt-4">{{$title}} ({{$usersCount}})</h1>
         <hr>

         @if (session('msg'))
             <div class="alert alert-success">
                {{session('msg')}}</div>
         @endif

        <div class="col-6">
            <h3>Lista de usuários</h3>
            <hr>

            <div class="d-flex">
              <select wire:model.live='numberRows' class="form-control" style="width: 3rem; margin-right:1rem">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
              </select>
             <input wire:model.live='search' type="text" class="form-control" placeholder="buscar...">
            </div>
            <table class="table">
                 <thead>
                    <tr>
                      <th>#</th>
                      <th>Nome</th>
                      <th>Email</th>
                    </tr>
                 </thead>
                 <tbody>
                    @foreach ($users as $user)
                    <tr>
                       <td>{{$user->id}}</td>
                       <td>{{$user->name}}</td>
                       <td>{{$user->email}}</td> 
                    </tr>
                    @endforeach
                 </tbody>
            </table>
            {{$users->links()}}
         </div>

        <div class="col-6">
            <h3>Criar usuários</h3>
            <hr>

            <form wire:submit='createUser'>
            <div class="mb-3">
               <input wire:model='name' class="form-control" type="text" placeholder="Nome">
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>   
        
        <div class="mb-3">
             <input wire:model='email' class="form-control" type="email" placeholder="Email">
             @error('email')
             <p class="text-danger">{{$message}}</p>
             @enderror
        </div>

        <div class="mb-3">
             <input wire:model='password' class="form-control" type="password" placeholder="Senha">
             @error('password')
             <p class="text-danger">{{$message}}</p>
             @enderror
        </div>

        <div class="mb-3">
            <input wire:model='image' type="file" accept="image/png, image/jpeg">
             @error('image')
             <p class="text-danger">{{$message}}</p>
             @enderror
        </div>
        
        <button class="btn btn-primary">Criar Usuário</button>
    </form>

        </div>
    </div>
</div>


