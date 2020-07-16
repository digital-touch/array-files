<template>

  <default-field :field="field" :errors="errors">

    <template slot="field">

      <input
          :id="field.name"
          :name="field.name"
          class="hidden"
          type="text"
          v-model="value"
      >

      <input
          @change="fileSelected"
          class="hidden"
          ref="add_file"
          type="file"
      />

      <button
          @click="$refs.add_file.click()"
          class="no-underline flex flex-col items-center justify-center bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded"
          type="button"
      >
        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink"
             viewBox="0 0 477.863 477.863" xml:space="preserve">
          <path d="M409.598,153.596h-85.333c-9.426,0-17.067,7.641-17.067,17.067s7.641,17.067,17.067,17.067h85.333
              c9.426,0,17.067,7.641,17.067,17.067v221.867c0,9.426-7.641,17.067-17.067,17.067H68.265c-9.426,0-17.067-7.641-17.067-17.067
              V204.796c0-9.426,7.641-17.067,17.067-17.067h85.333c9.426,0,17.067-7.641,17.067-17.067s-7.641-17.067-17.067-17.067H68.265
              c-28.277,0-51.2,22.923-51.2,51.2v221.867c0,28.277,22.923,51.2,51.2,51.2h341.333c28.277,0,51.2-22.923,51.2-51.2V204.796
              C460.798,176.519,437.875,153.596,409.598,153.596z"/>

          <path d="M336.331,90.33L250.998,4.997c-6.664-6.663-17.468-6.663-24.132,0L141.532,90.33c-6.548,6.78-6.36,17.584,0.42,24.132
              c6.614,6.388,17.099,6.388,23.713,0l56.201-56.201V341.33c0,9.426,7.641,17.067,17.067,17.067s17.067-7.641,17.067-17.067V58.262
              l56.201,56.201c6.78,6.548,17.584,6.36,24.132-0.42C342.719,107.429,342.719,96.944,336.331,90.33z"/>

        </svg>

        <span class="pt-2">{{ __('Upload File') }}</span>

      </button>

      <p v-if="this.hasError" class="my-2 text-danger">
        {{ firstError }}
      </p>

      <div class="flex flex-col pt-2 text-center">

        <div v-for="(file, index) in files" class="card pt-2 mb-2 rounded-3 shadow-md flex flex-col bg-primary"
             style="-ms-word-wrap: break-word;word-wrap: break-word;">

          <div class="flex flex-row items-center justify-center flex-1 text-white px-1 pb-2">
            <svg class="w-16 h-16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink"
                 viewBox="0 0 512 512" xml:space="preserve">
              <path d="M464.217,114.566L352.913,3.261C350.831,1.169,348.004,0,345.043,0H77.913
                    c-18.41,0-33.391,14.982-33.391,33.391v445.217c0,18.41,14.982,33.391,33.391,33.391h356.174c18.399,0,33.38-14.97,33.391-33.369
                    c0-0.011,0-0.011,0-0.022V122.435C467.478,119.485,466.31,116.647,464.217,114.566z M133.565,133.565V89.043h178.087v44.522
                    H133.565z M445.217,478.609c0,6.144-4.986,11.13-11.13,11.13H77.913c-6.133,0-11.13-4.986-11.13-11.13V33.391
                    c0-6.133,4.998-11.13,11.13-11.13h233.739v44.522H122.435c-6.144,0-11.13,4.986-11.13,11.13v66.783
                    c0,6.144,4.986,11.13,11.13,11.13h200.348h122.435V478.609z M445.217,133.565H333.913V22.261h6.522l104.782,104.782V133.565z"/>
              <path d="M122.435,222.609H256c6.144,0,11.13-4.986,11.13-11.13s-4.986-11.13-11.13-11.13H122.435
                    c-6.144,0-11.13,4.986-11.13,11.13S116.291,222.609,122.435,222.609z"/>
              <path d="M122.435,356.174H256c6.144,0,11.13-4.975,11.13-11.13c0-6.155-4.986-11.13-11.13-11.13H122.435
                    c-6.144,0-11.13,4.975-11.13,11.13C111.304,351.199,116.291,356.174,122.435,356.174z"/>
              <path d="M111.304,278.261c0,6.155,4.986,11.13,11.13,11.13h267.13c6.155,0,11.13-4.975,11.13-11.13
                    c0-6.155-4.975-11.13-11.13-11.13h-267.13C116.291,267.13,111.304,272.106,111.304,278.261z"/>
              <path d="M389.565,400.696h-267.13c-6.144,0-11.13,4.975-11.13,11.13s4.986,11.13,11.13,11.13h267.13
                    c6.155,0,11.13-4.975,11.13-11.13S395.72,400.696,389.565,400.696z"/>
            </svg>

            <a v-show="!originalNameInputVisible[index]" :href="file.url"
               class="inline-block m-2 p-2 text-base text-left text-white no-underline w-full"
               target="_blank">{{ file.originalName }}</a>

            <input v-show="originalNameInputVisible[index]"
                   type="text"
                   @keydown.enter.prevent="editOriginalNameComplete(index)"
                   @keydown.esc.prevent="editOriginalNameCancel(index)"
                   class="border border-primary p-2 text-base text-primary m-2 rounded-lg w-full bg-primary-30"
                   v-model="file.originalName"
            >
          </div>

          <div class="flex flex-row items-stretch pl-2 py-2 items-center justify-center bg-white">

            <a v-show="originalNameInputVisible[index]"
                @click="editOriginalNameCancel(index)"
                class="o-underline cursor-pointer flex flex-col items-center justify-center bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded mr-2"
            >

              <svg class="h-8 w-8 m-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                   xmlns:xlink="http://www.w3.org/1999/xlink"
                   viewBox="0 0 512.001 512.001" xml:space="preserve">
                  <path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717
                    L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859
                    c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287
                    l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285
                    L284.286,256.002z"/>
              </svg>

              <span>{{ __('Cancel') }}</span>
            </a>

            <a v-show="originalNameInputVisible[index]"
                @click.prevent="editOriginalNameComplete(index)"
                class="o-underline cursor-pointer flex flex-col items-center justify-center bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded mr-2"
                >

              <svg class="h-8 w-8 m-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                   xmlns:xlink="http://www.w3.org/1999/xlink"
                   viewBox="0 0 426.667 426.667"
                   xml:space="preserve">
                  <path d="M421.876,56.307c-6.548-6.78-17.352-6.968-24.132-0.42c-0.142,0.137-0.282,0.277-0.42,0.42L119.257,334.375
                    l-90.334-90.334c-6.78-6.548-17.584-6.36-24.132,0.42c-6.388,6.614-6.388,17.099,0,23.713l102.4,102.4
                    c6.665,6.663,17.468,6.663,24.132,0L421.456,80.44C428.236,73.891,428.424,63.087,421.876,56.307z"/>
              </svg>
              <span>{{ __('Save') }}</span>
            </a>

            <a @click.prevent="prevIndex(index)" v-if="files ? index > 0 : false"
               v-show="!originalNameInputVisible[index]"
               class="o-underline cursor-pointer flex flex-col items-center justify-center bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded mr-2">
              <svg class="w-8 h-8 m-2" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                   fill="currentColor"
                   clip-rule="evenodd" viewBox="0 0 24 24">
                <path d="M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z"/>
              </svg>
              <span class="font-bold">{{ __('Pop File Index') }}</span>
            </a>

            <a @click.prevent="editOriginalName(index)"
               v-show="!originalNameInputVisible[index]"
               class="no-underline cursor-pointer flex flex-col items-center justify-center bg-primary hover:bg-primary-light text-white font-bold py-2 px-4 rounded mr-2">
              <svg class="w-8 h-8 m-2" viewBox="0 0 512 512"
                   fill="currentColor"
                   xmlns="http://www.w3.org/2000/svg">
                <path
                    d="m384.721 0-323.626 323.627-61.095 188.373 188.374-61.094 323.626-323.627zm84.853 127.279-42.427 42.427-84.853-84.853 42.426-42.427zm-388.611 232.331 71.427 71.428-32.036 10.39-49.782-49.782zm14.501-27.925 225.617-225.618 31.82 31.82-225.618 225.617zm53.032 53.032 225.618-225.619 31.82 31.82-225.618 225.619zm-88.313 38.965 28.136 28.136-41.642 13.505z"/>
              </svg>
              <span class="font-bold">{{ __('Edit Name') }}</span>
            </a>
            <a @click.prevent="deleteFile(index)"
               v-show="!originalNameInputVisible[index]"
               class="no-underline cursor-pointer flex flex-col items-center justify-center bg-danger hover:bg-danger-dark text-white font-bold py-2 px-4 rounded">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 m-2"
                   fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                   stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
              </svg>
              <span class="font-bold">{{ __('Remove File') }}</span>
            </a>
            <a @click.prevent="nextIndex(index)" v-if="files ? index < (files.length - 1):false"
               v-show="!originalNameInputVisible[index]"
               class="no-underline cursor-pointer flex flex-col items-center justify-center bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded ml-2">
              <svg class="w-8 h-8 m-2" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                   viewBox="0 0 24 24" fill="currentColor"
                   clip-rule="evenodd">
                <path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/>
              </svg>
              <span class="font-bold">{{ __('Push File Index') }}</span>
            </a>
          </div>
        </div>
      </div>
    </template>
  </default-field>
</template>

<script>
import Vue from 'vue';
import {FormField, HandlesValidationErrors} from 'laravel-nova';

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  data() {
    return {
      originalNameInputVisible: [],
      originalNameUndo: [],
      selectedFile: null,
      files: [],
    }
  },

  methods: {
    /**
     * Selected file event trigger
     */
    fileSelected(event) {
      let app = this;
      const fd = new FormData();
      fd.append('file', event.target.files[0], event.target.files[0].name);
      fd.append('disk', this.field.disk);
      fd.append('path', this.field.path);

      axios.post('/nova-vendor/array-files/upload', fd)
          .then(res => {
            app.files.push(res.data);
            app.value = JSON.stringify(app.files);
          })
    },

    prevIndex(index) {
      let indexOf = index;
      indexOf--;
      if (indexOf < 0) {
        indexOf = 0;
      }
      if (index === indexOf) {
        return;
      }
      this.moveArrayItemToNewIndex(this.files, index, indexOf);
      this.value = JSON.stringify(this.files)
    },

    nextIndex(index) {
      let indexOf = index;
      indexOf++;
      if (indexOf > (this.files.length - 1)) {
        indexOf = this.files.length - 1;
      }
      if (index === indexOf) {
        return;
      }
      this.moveArrayItemToNewIndex(this.files, index, indexOf);
      this.value = JSON.stringify(this.files)

    },

    moveArrayItemToNewIndex(array, oldIndex, newIndex) {
      if (newIndex >= array.length) {
        let k = newIndex - array.length + 1;
        while (k--) {
          array.push(undefined);
        }
      }
      array.splice(newIndex, 0, array.splice(oldIndex, 1)[0]);
      return array;
    },

    editOriginalName(index) {
      Vue.set(this.originalNameUndo, index, this.files[index].originalName);
      Vue.set(this.originalNameInputVisible, index, !this.originalNameInputVisible[index]);
    },

    editOriginalNameComplete(index) {
      Vue.set(this.originalNameInputVisible, index, !this.originalNameInputVisible[index]);
      this.value = JSON.stringify(this.files)
    },

    editOriginalNameCancel(index) {
      Vue.set(this.originalNameInputVisible, index, !this.originalNameInputVisible[index]);
      this.files[index].originalName = this.originalNameUndo[index];
      this.value = JSON.stringify(this.files)
    },

    deleteFile(index) {
      axios.delete('/nova-vendor/array-files/delete/' + this.files[index].name)
      this.files.splice(index, 1)
      this.value = JSON.stringify(this.files)
    },

    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {

      this.value = this.field.value || ''

      this.originalNameInputVisible = [];
      this.originalNameUndo = [];

      this.files = JSON.parse(this.field.value) || []

      this.originalNameInputVisible.length = this.files.length;
      this.originalNameInputVisible.fill(false);

      this.originalNameUndo.length = this.files.length;

      this.files.forEach((file, index) => {
        Vue.set(this.originalNameUndo, index, file.originalName);
      });
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || '')
    },

    /**
     * Update the field's internal value.
     */
    handleChange(value) {
      this.value = value
    },
  },
}
</script>
