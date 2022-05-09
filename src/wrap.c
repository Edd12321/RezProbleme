#include <linux/seccomp.h>
#include <seccomp.h>
#include <sys/prctl.h>

/** Scop: execvp(3) **/
#include <unistd.h>

int
main(int argc, char *argv[])
{
  scmp_filter_ctx filtru = seccomp_init(SCMP_ACT_KILL);
  seccomp_rule_add(filtru, SCMP_ACT_ALLOW, SCMP_SYS(read), 0);
  seccomp_rule_add(filtru, SCMP_ACT_ALLOW, SCMP_SYS(write), 0);
  seccomp_rule_add(filtru, SCMP_ACT_ALLOW, SCMP_SYS(exit), 0);
  seccomp_rule_add(filtru, SCMP_ACT_ALLOW, SCMP_SYS(rt_sigreturn), 0);

  execvp(argv[1], &argv[1]);
}
