#include <linux/seccomp.h>
#include <seccomp.h>
#include <sys/prctl.h>

/** Scop: execvp(3) **/
#include <unistd.h>

int
main(int argc, char *argv[])
{
  /** tot in whitelist **/
  scmp_filter_ctx filtru = seccomp_init(SCMP_ACT_ALLOW);

  /* blocare acces fisiere */
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(fstat), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(unlink), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(unlinkat), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(stat), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(open), 0);


  /* blocare acces retea */
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(socket), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(socketpair), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(getsockopt), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(getsockname), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(getpeername), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(bind), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(listen), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(accept), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(accept4), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(connect), 0);
  seccomp_rule_add(filtru, SCMP_ACT_KILL, SCMP_SYS(shutdown), 0);

  seccomp_load(filtru);

  execvp(argv[1], &argv[1]);
  seccomp_release(filtru);
}
