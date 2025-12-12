import controller_0 from "../ux-turbo/turbo_controller.js";
import controller_1 from "../../controllers/autosubmit_controller.js";
import controller_2 from "../../controllers/details_controller.js";
import controller_3 from "../../controllers/displayview_controller.js";
import controller_4 from "../../controllers/hello_controller.js";
export const eagerControllers = {"symfony--ux-turbo--turbo-core": controller_0, "autosubmit": controller_1, "details": controller_2, "displayview": controller_3, "hello": controller_4};
export const lazyControllers = {"csrf-protection": () => import("../../controllers/csrf_protection_controller.js")};
export const isApplicationDebug = true;