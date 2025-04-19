<template>
    <div>
        <nav class="navbar navbar-expand navbar-light bg-light px-3">
            <a class="navbar-brand" href="/">SIPPEKA</a>
            <ul class="navbar-nav">
                <li class="nav-item"><router-link class="nav-link" to="/">Home</router-link></li>
                <li class="nav-item"><router-link class="nav-link" to="/about">About</router-link></li>
            </ul>
        </nav>

        <div class="container mt-4">
            <router-view></router-view>
        </div>
    </div>
</template>
