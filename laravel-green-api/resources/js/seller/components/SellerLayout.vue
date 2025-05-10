<template>
    <div>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>{{ $route.name }} Page</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="#">{{ $route.path }}</a>
                                </li>
                                <!-- <li class="breadcrumb-item active">{{ $route.name }} Page</li> -->
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <router-view/>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
    </div>
</template>
<script>
export default {};
</script>
<style lang=""></style>
