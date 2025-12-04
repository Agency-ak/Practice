<header>
    <div class="d-flex gap-5 align-items-center justify-content-between p-3 bg-dark shadow text-white ">
        <h3 class="text-uppercase">{{ session('user')->role}} Dashboard</h3>

        <div class="dropdown">
            <button class="btn btn-transparent text-white border border-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i> {{ session('user')->name }}
            </button>
            <ul class="dropdown-menu rounded-0">
                <li>
                    <!-- edit -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn dropdown-item rounded-0" data-bs-toggle="modal" data-bs-target="#editSelf">
                        <i class="fa-solid fa-user-pen"></i> Edit Profile
                    </button>
                </li>
                <li>
                    <button type="button" class="btn dropdown-item rounded-0 text-danger" data-bs-toggle="modal" data-bs-target="#logout">
                        <i class="fa-solid fa-right-from-bracket" style="transform: rotate(180deg);"></i> Logout
                    </button>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- edit self -->

<!-- Edit student modal -->
<!-- Modal -->
<div class="modal fade" id="editSelf" tabindex="-1" aria-labelledby="editSelfLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-start">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editSelfLabel">Edit Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/edituser" method="POST" class="form d-flex flex-column p-3 ">
                    @csrf

                    <label class="form-label mt-3" for="username">New Username</label>
                    <input type="hidden" name="id" value="{{ session('user')->id }}">
                    <input class="form-control" name="name" type="text" placeholder="username">

                    <label class="form-label mt-3" for="Password">Old Password</label>
                    <div class="d-flex border border-1 rounded align-items-center">
                        <input class="form-control border-0 w-100 p-2" name="oldPassword" id="Password" type="password" placeholder="Old Password">
                        <button type="button" id="eye" class="bg-transparent border-0 eye"><i class="fa-solid fa-eye mx-2"></i></button>
                    </div>
                    <label class="form-label mt-3" for="Password">New Password</label>
                    <div class="d-flex border border-1 rounded align-items-center">
                        <input class="form-control border-0 w-100 p-2" name="newPassword" id="newPassword" type="password" placeholder="New Password">
                        <button type="button" id="eyeNew" class="bg-transparent border-0 eye"><i class="fa-solid fa-eye mx-2"></i></button>
                    </div>
                    <label class="form-label mt-3" for="ConfirmPassword">Confirm Password</label>
                    <div class="d-flex border border-1 rounded align-items-center">
                        <input class="form-control border-0 w-100 p-2" name="confirmPassword" id="confirmPassword" type="password" placeholder="Confirm Password">
                        <button type="button" id="eyeConfirm" class="bg-transparent border-0 eye"><i class="fa-solid fa-eye mx-2"></i></button>
                    </div>
                    <input type="hidden" name="role" value="{{ session('user')->role }}">
                    <button class="mt-4 rounded border-1 btn btn-primary" type="submit">Confirm Changes</button>

                </form>
            </div>
        </div>
    </div>

</div>

<!-- logout -->
<!-- Modal -->
<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="logoutLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-start">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="logoutLabel">Confrim Logout</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to Logout ?
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="/logout">Yes</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>