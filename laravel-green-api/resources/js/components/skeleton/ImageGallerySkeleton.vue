<template>
    <div class="row">
        <div
            class="col-md-2 mt-3"
            v-for="(data, index) in dataAmounts"
            :key="index"
        >
            <div class="ssc ssc-card">
                <div class="ssc-wrapper">
                    <div class="flex align-start">
                        <div class="mr w-100">
                            <!-- <div class="ssc-line"></div> -->
                            <div class="ssc-square mb w-100 h-400"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["dataAmounts"],
};
</script>
<style></style>
