import Post from './admin/Post/post';
import AddPost from './admin/Post/addpost';
import ListCategory from './admin/Category/listcategory';
import AddCategory from './admin/Category/category';
import EditCategory from './admin/Category/editcategory';
import EditPost from './admin/Post/editpost';
import Account from './admin/Account/account';
import ContentBlog from './components/ContentBlog';
import AboutMe from './components/AboutMe';
import PostDetail from './components/PostDetail';
import Project from './admin/Project/listproject';
import AddProject from './admin/Project/addproject';
import EditProject from './admin/Project/editproject';
import AllProject from './components/Project';
import ProjectDetail from './components/ProjectDetail';


const routes = [
    {
        path: '/post',
        component: Post,
        name: 'post',
    },
    {
        path: '/addpost',
        component: AddPost,
        name: 'addpost',
    },
    {
        path: '/category',
        component: ListCategory,
        name: 'listcategory',
    },
    {
        path: '/add-category',
        component: AddCategory,
        name: 'addcategory',
    },
    {
        path: '/edit-category/:id',
        component: EditCategory,
        name: 'editcategory',
    },
    {
        path: '/edit-post/:id',
        component: EditPost,
        name: 'editpost',
    },
    {
        path: '/account',
        component: Account,
        name: 'account',
    },
    {
        path: '/',
        component: ContentBlog,
        name: 'contentblog',
    },
    {
        path: '/home',
        component: ContentBlog,
        name: 'contentblog',
    },
    {
        path: '/aboutme',
        component: AboutMe,
        name: 'aboutme',
    },
    {
        path: '/postdetail/:id',
        component: PostDetail,
        name: 'postdetail',
    },
    {
        path: '/project',
        component: Project,
        name: 'listproject',
    },
    {
        path: '/addproject',
        component: AddProject,
        name: 'addproject',
    },
    {
        path: '/editproject/:id',
        component: EditProject,
        name: 'editproject',
    },
    {
        path: '/allproject',
        component: AllProject,
        name: 'allproject',
    },
    {
        path: '/projectdetail/:id',
        component: ProjectDetail,
        name: 'projectdetail',
    },
    
];

export default routes;