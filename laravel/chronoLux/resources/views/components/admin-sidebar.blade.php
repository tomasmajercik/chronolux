<aside>
    <div class="sidebar-button" onclick="openSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="17" viewBox="0 0 23 17" fill="none">
            <path d="M1.875 15.375H12.875M1.875 8.5H21.125M1.875 1.625H12.875" stroke="black" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>
    <div class="sidebar" id="sidebar">
        <div class="close" onclick="openSidebar()">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path
                    d="M2 17.75L0.25 16L7.25 9L0.25 2L2 0.25L9 7.25L16 0.25L17.75 2L10.75 9L17.75 16L16 17.75L9 10.75L2 17.75Z"
                    fill="black" />
            </svg>
        </div>
        <ul>
            <li class="{{ $active === 'statistics' ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                    <path
                        d="M20 14.725L25.3 5.5625L27.4625 6.8125L20.925 18.125L12.7875 13.4375L6.825 23.75H27.5V26.25H2.5V3.75H5V21.925L11.875 10L20 14.725Z" fill="black" />
                </svg>
                <a href="{{ route('admin.dashboard') }}">Statistics</a>
            </li>
            <li class="{{ $active === 'addProduct' ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                    <path
                        d="M21.25 5H8.75C7.36929 5 6.25 6.11929 6.25 7.5V23.75C6.25 25.1307 7.36929 26.25 8.75 26.25H21.25C22.6307 26.25 23.75 25.1307 23.75 23.75V7.5C23.75 6.11929 22.6307 5 21.25 5Z"
                        stroke="black" stroke-width="2" />
                    <path d="M11.25 11.25H18.75M11.25 16.25H18.75M11.25 21.25H16.25" stroke="black" stroke-width="2"
                        stroke-linecap="round" />
                </svg>
                 <a href="{{ route('admin.addProduct') }}">Add Product</a>
            </li>
            <li class="{{ $active === 'editProduct' ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                    <path
                        d="M3.75 21.5625V26.25H8.4375L22.2625 12.425L17.575 7.7375L3.75 21.5625ZM25.8875 8.8C26.0034 8.68436 26.0953 8.547 26.158 8.39578C26.2208 8.24457 26.2531 8.08246 26.2531 7.91875C26.2531 7.75504 26.2208 7.59294 26.158 7.44172C26.0953 7.29051 26.0034 7.15315 25.8875 7.0375L22.9625 4.1125C22.8469 3.99662 22.7095 3.90469 22.5583 3.84196C22.4071 3.77924 22.245 3.74695 22.0813 3.74695C21.9175 3.74695 21.7554 3.77924 21.6042 3.84196C21.453 3.90469 21.3156 3.99662 21.2 4.1125L18.9125 6.4L23.6 11.0875L25.8875 8.8Z"
                        fill="black" />
                </svg>
                <a href="{{ route('admin.editProduct') }}">Edit Product</a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                    <path
                        d="M5 15H16.875M7.5 18.75L3.75 15L7.5 11.25M13.75 8.75V7.5C13.75 6.83696 14.0134 6.20107 14.4822 5.73223C14.9511 5.26339 15.587 5 16.25 5H22.5C23.163 5 23.7989 5.26339 24.2678 5.73223C24.7366 6.20107 25 6.83696 25 7.5V22.5C25 23.163 24.7366 23.7989 24.2678 24.2678C23.7989 24.7366 23.163 25 22.5 25H16.25C15.587 25 14.9511 24.7366 14.4822 24.2678C14.0134 23.7989 13.75 23.163 13.75 22.5V21.25"
                        stroke="red" stroke-width="2.83333" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                    @csrf
                    <button class="logout" type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</aside>