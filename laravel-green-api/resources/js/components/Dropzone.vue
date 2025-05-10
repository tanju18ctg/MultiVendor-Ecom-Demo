<template>
    <div class="parent">
        <h4>Bootstrap Modal Parent</h4>
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-secondary" @click="showModal">
                    Open Bootstrap Modal
                </button>
            </div>
        </div>
        <bootstrap-modal-no-jquery
            v-if="displayModal"
            @close-modal-event="hideModal"
            :multiImg="getMultiImg"
        />

        <!-- <div v-for="(dat, index) in data" :key="index">
            <img :src="`/${dat}`" alt="" style="height: 100px; width: 100px" />
        </div> -->


            <div
                class="col-md-2"
                v-for="(img, index) in data"
                :key="index"
            >
                <div class="gallery-card">
                    <div class="gallery-card-body">
                        <label class="block-check">
                            <img
                                :src="`${img}`"
                                class="img-responsive img-rounded"
                            />
                            <input
                                type="checkbox"
                                :value="img.url"
                                v-model="selectData"
                            />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>

    </div>
</template>

<script>
import BootstrapModalNoJquery from "./BootstrapModalNoJquery.vue";

export default {
    components: {
        BootstrapModalNoJquery,
    },
    data() {
        return {
            displayModal: false,
            data: [],
        };
    },
    methods: {
        showModal() {
            this.displayModal = true;
        },
        hideModal() {
            this.displayModal = false;
        },

        getMultiImg(imgs) {
            this.data = imgs;
        },
    },
};
</script>

<style lang="" scoped></style>
