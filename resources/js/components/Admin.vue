<template>

	<v-app>
		<!-- <v-navigation-drawer clipped right app v-model="drawer" :mini-variant.sync="mini" hide-overlay stateless class="elevation-3">
			<v-toolbar flat class="transparent">
				<v-list class="pa-0">
					<v-list-tile avatar>
						<v-list-tile-avatar>
							<img src="https://randomuser.me/api/portraits/men/85.jpg">
						</v-list-tile-avatar>

						<v-list-tile-content>
							<v-list-tile-title>{{ userName }}</v-list-tile-title>
						</v-list-tile-content>

						<v-list-tile-action>
							<v-btn icon @click.stop="mini = !mini">
								<v-icon>chevron_right</v-icon>
							</v-btn>
						</v-list-tile-action>
					</v-list-tile>
				</v-list>
			</v-toolbar>

			<v-list dense>
				<template v-for="item in items">
					<v-layout v-if="item.heading" :key="item.heading" row align-center>
						<v-flex xs6>
							<v-subheader v-if="item.heading">
								{{ item.heading }}
							</v-subheader>
						</v-flex>
						<v-flex xs6 class="text-xs-center">
							<a href="#!" class="body-2 black--text">EDIT</a>
						</v-flex>
					</v-layout>
					<v-list-group v-else-if="item.children" :key="item.text" v-model="item.model" :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="">
						<template v-slot:activator>
							<v-list-tile>
								<v-list-tile-content>
									<v-list-tile-title>
										{{ item.text }}
									</v-list-tile-title>
								</v-list-tile-content>
							</v-list-tile>
						</template>
						<v-list-tile v-for="(child, i) in item.children" :key="i">
							<v-list-tile-action v-if="child.icon">
								<v-icon>{{ child.icon }}</v-icon>
							</v-list-tile-action>
							<v-list-tile-content>
								<v-list-tile-title>
									{{ child.text }}
								</v-list-tile-title>
							</v-list-tile-content>
						</v-list-tile>
					</v-list-group>
					<v-list-tile v-else :key="item.text" @click="">
						<v-list-tile-action>
							<v-icon>{{ item.icon }}</v-icon>
						</v-list-tile-action>
						<v-list-tile-content @click="goTo(item.route)">
							<v-list-tile-title>
								{{ item.text }}
							</v-list-tile-title>
						</v-list-tile-content>
					</v-list-tile>
				</template>
			</v-list>
		</v-navigation-drawer> -->

		<v-navigation-drawer clipped right app v-model="drawer" :mini-variant.sync="mini" hide-overlay stateless class="elevation-3">
			<v-list>
				<div v-for="(menu_item, menu_item_key) in side_menu_links" :key="menu_item_key">
					<div v-if="menu_item.children.length">
						<v-list-group :prepend-icon="menu_item.icon">
							<template v-slot:activator>
								<v-list-tile>
									<v-list-tile-title>{{ menu_item.title }}</v-list-tile-title>
								</v-list-tile>
							</template>

							<v-list-tile v-for="(child, i) in menu_item.children" :key="i" @click="goTo(child.route)">
								<v-list-tile-title v-text="child.title"></v-list-tile-title>
								<v-list-tile-action>
									<v-icon v-text="child.icon"></v-icon>
								</v-list-tile-action>
							</v-list-tile>
						</v-list-group>
					</div>
					<div v-else>
						<v-list-tile @click="goTo(menu_item.route)">
							<v-list-tile-action>
								<v-icon>{{ menu_item.icon }}</v-icon>
							</v-list-tile-action>
							<v-list-tile-title>{{ menu_item.title }}</v-list-tile-title>
						</v-list-tile>
					</div>
				</div>
			</v-list>
		</v-navigation-drawer>


		<v-toolbar app dark color="primary">
			<v-toolbar-side-icon @click.stop="mini = !mini"></v-toolbar-side-icon>

			<v-toolbar-title class="white--text">پنل مدیریت فانوس</v-toolbar-title>

			<v-spacer></v-spacer>

			<v-menu v-model="menu" :close-on-content-click="false" :nudge-width="200" offset-x>
				<template v-slot:activator="{ on }">
					<v-btn icon dark v-on="on">
						<v-badge color="red">
							<template v-slot:badge>
								<span>3</span>
							</template>
							<v-icon color="lighten-1">
								notifications
							</v-icon>
						</v-badge>
					</v-btn>
				</template>

				<v-card>
					<v-list two-line>
						<template v-for="(item, index) in notifications">
							<v-subheader v-if="item.header" :key="item.header">
								{{ item.header }}
							</v-subheader>

							<v-divider v-else-if="item.divider" :key="index" :inset="item.inset"></v-divider>

							<v-list-tile v-else :key="item.title" avatar @click="">
								<v-list-tile-avatar>
									<img :src="item.avatar">
								</v-list-tile-avatar>

								<v-list-tile-content>
									<v-list-tile-title v-html="item.title"></v-list-tile-title>
									<v-list-tile-sub-title v-html="item.subtitle"></v-list-tile-sub-title>
								</v-list-tile-content>
							</v-list-tile>
						</template>
					</v-list>
				</v-card>
			</v-menu>

			<v-btn icon>
				<v-icon>search</v-icon>
			</v-btn>

			<v-btn icon>
				<v-icon>apps</v-icon>
			</v-btn>

			<v-btn icon @click="refresh_page()">
				<v-icon>refresh</v-icon>
			</v-btn>

			<v-btn icon>
				<v-icon>more_vert</v-icon>
			</v-btn>
		</v-toolbar>


		<v-content>
			<v-container fluid align-start justify-start row fill-height>
				<div id="main">
					<router-view></router-view>
				</div>
			</v-container>
		</v-content>
	</v-app>

</template>


<script>
	export default {
		props: {
			userId: {
				type: Number,
				required: true
			},
			userName: {
				type: String,
				required: true
			}
		},
		mounted() {
			axios
				.get('/api/admin/modules')
				.then(response => {
					console.log(response.data);
				});
		},
		data() {
			return {
				side_menu_links: [
					{
						title: 'داشبورد',
						icon: 'dashboard',
						route: 'home',
						children: [],
					},{
						title: 'تنظیمات',
						icon: 'settings',
						route: 'settings',
						children: [],
					},{
						title: 'ماژول ها',
						icon: 'view_module',
						children: [
							{
								title: 'مشاهده',
								icon: 'people_outline',
								route: 'modules',
							},
							{
								title: 'افزودن',
								icon: 'add',
								route: 'modules/add',
							},
							{
								title: 'تنظیمات',
								icon: 'settings',
								route: 'modules/settings',
							},
						],
					},{
						title: 'کاربران',
						icon: 'account_circle',
						children: [
							{
								title: 'مشاهده',
								icon: 'people_outline',
								route: 'users',
							},
							{
								title: 'افزودن',
								icon: 'add',
								route: 'users/add',
							},
							{
								title: 'تنظیمات',
								icon: 'settings',
								route: 'users/settings',
							},
						],
					}
				],


				drawer: true,
				mini: false,
				right: null,
				fav: true,
				menu: false,
				message: false,
				hints: true,
				notifications: [{
						header: 'نوتیفیکیشن ها'
					},
					{
						avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
						title: 'ثبت نام کاربر جدید',
						subtitle: "کاربری بنام سامان جلیلی ثبت نام کرد"
					},
					{
						divider: true,
						inset: true
					},
					{
						avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
						title: 'ارسال فرم تماس باما',
						subtitle: "میثم ابراهیم زاده فرم تماس باما ارسال کرد"
					},
					{
						divider: true,
						inset: true
					},
					{
						avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
						title: 'ثبت سفارش وب سرویس',
						subtitle: "محمد علیزاده سفارش وب سرویس یک ماهه گروه دوم را ثبت کرد"
					}
				]
			};
		},
		methods: {
			logout() {
				axios.post("/logout").then(() => {
					window.location = "/";
				});
			},
			goTo(route) {
				this.$router.push(`/admin/${route}`);
			},
			refresh_page() {
				this.$router.go(0);
			}
		}
	};
</script>