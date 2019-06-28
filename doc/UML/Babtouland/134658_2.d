format 218

classcanvas 128130 class_ref 136322 // Message
  classdiagramsettings member_max_width 0 end
  xyz 225 164 2000
end
classcanvas 128258 class_ref 135426 // Managed
  classdiagramsettings member_max_width 0 end
  xyz 94 313 2000
end
classcanvas 128386 class_ref 128642 // Manager
  classdiagramsettings member_max_width 0 end
  xyz 469 25 2000
end
classcanvas 128514 class_ref 136450 // ManagerMessage
  classdiagramsettings member_max_width 0 end
  xyz 465 317 2005
end
relationcanvas 128642 relation_ref 136962 // <generalisation>
  from ref 128514 z 2006 to ref 128386
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 128770 relation_ref 137090 // <generalisation>
  from ref 128130 z 2001 to ref 128258
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 128898 relation_ref 137218 // <association>
  from ref 128130 z 2006 to ref 128514
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
end
