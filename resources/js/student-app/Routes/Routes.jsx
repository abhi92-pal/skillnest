export const WEB_BASE_URL = 'http://skillnest.test/';
export const API_BASE_URL = WEB_BASE_URL + 'api/';

// ############ Web urls ############ 
export const WELCOME_PAGE = '/';
export const ABOUT_US_PAGE = '/about-us';
export const COURSES_PAGE = '/courses';
export const COURSE_DETAILS_PAGE = '/course/:courseId';
export const MY_COURSES_PAGE = '/my-courses';
export const MY_COURSE_DETAILS_PAGE = '/my-course/:courseId';
export const PROFILE_PAGE = '/profile';

// ############ Api endpoints ############ 
export const COURSE_CATEGORY_API = API_BASE_URL + 'category-list';
export const TEACHERS_API = API_BASE_URL + 'teachers';
export const LOGIN_API = API_BASE_URL + 'login';
export const AUTH_REFRESH_API = API_BASE_URL + 'refresh';
export const REGISTER_API = API_BASE_URL + 'register';

// Courses API
export const COURSES_API = API_BASE_URL + 'courses';
export const COURSE_DETAILS_API = API_BASE_URL + `course/_courseId_/details`;
export const MY_COURSES_API = API_BASE_URL + 'my-courses';
export const MY_COURSE_DETAILS_API = API_BASE_URL + `my-course/_courseId_/details`;

