<template>
	<div>
		<div class="title font-weight-light" id="page-title">
			<v-icon medium color="blue darken-2">settings</v-icon> تنظیمات
		</div>

		<template>
			<v-tabs color="cyan" dark icons-and-text align-with-title>
				<v-tabs-slider color="yellow"></v-tabs-slider>

				<v-tab href="#tab-core">
					اصلی
					<v-icon>home</v-icon>
				</v-tab>

				<v-tab href="#tab-chats">
					چت و گفتگو
					<v-icon>chats</v-icon>
				</v-tab>

				<v-tab href="#tab-users">
					کاربران
					<v-icon>account_box</v-icon>
				</v-tab>

				<v-tab-item v-for="(setting_group, key) in settings" :key="key" :value="'tab-' + key">
					<v-card flat>
						<v-card-text>
							<div v-for="(setting, index) in setting_group" :key="index">
								<div v-if="setting.type == 'textfield'">
									<v-text-field :label="setting.title" :value="setting.value"></v-text-field>
								</div>

								<div v-else-if="setting.type === 'textarea'">
									<v-textarea :label="setting.title" :value="setting.value"></v-textarea>
								</div>

								<div v-else-if="setting.type === 'select'">
									<v-select v-model="e1" :items="states" menu-props="auto" :label="setting.title"></v-select>
								</div>

								<div v-else-if="setting.type === 'tags'">
									<v-text-field :label="setting.title" :value="setting.value"></v-text-field>
								</div>

								<div v-else-if="setting.type === 'number'">
									<v-text-field :label="setting.title" :value="setting.value"></v-text-field>
								</div>

								<div v-else-if="setting.type === 'wysiwyg'">
									<froala :tag="'textarea'" :config="config" v-model="setting.value"></froala>
								</div>

								<div v-else-if="setting.type === 'colorpicker'">
									<div>
										<div class="colorpicker-component">
											<div class="colorpicker-preview" v-bind:style="{ background: setting.value }" v-on:click="pickerShow = !pickerShow"></div>
											<sketch-picker v-model="setting.value" :class="{ show: pickerShow }" />
										</div>
									</div>
								</div>
							</div>
						</v-card-text>

						<v-divider></v-divider>

						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn color="success" depressed>ثبت تنظیمات</v-btn>
						</v-card-actions>
					</v-card>
				</v-tab-item>
			</v-tabs>
		</template>
	</div>
</template>


<script>
	import VueFroala from 'vue-froala-wysiwyg';

	import { Sketch } from 'vue-color'

	var colors = '#194d33'

	export default {
		components: {
			'sketch-picker': Sketch,
		},
		mounted() {
			axios
				.get('/api/admin/settings')
				.then(response => {
					this.settings = response.data;
				});
		},
		data() {
			return {
				settings: [],
				e1: 'فانوس',
				states: [
					'فانوس',
					'شمیم'
				],
				config: {
					events: {
						'froalaEditor.initialized': function () {
							console.log('initialized')
						}
					},
					direction: 'rtl',
					height: 300
				},
				colors,
				pickerShow: false
			};
		},
		events: {
			
		},
		computed: {
			
		},
		methods: {
			close_colorpicker: function () {
				this.pickerShow = false;
			}
		}
	};
</script>